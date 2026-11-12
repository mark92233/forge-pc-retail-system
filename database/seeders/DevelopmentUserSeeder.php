<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DevelopmentUserSeeder extends Seeder
{
    public function run(): void
    {
        if (!app()->environment(['local', 'testing'])) {
            return;
        }

        $admin = DB::table('users')
            ->where('email', env('FORGE_ADMIN_EMAIL'))
            ->first();

        if (!$admin) {
            $this->command?->warn('Administrator account not found. Run AdminUserSeeder first.');

            return;
        }

        $accounts = [
            [
                'name' => 'Demo Customer',
                'email' => 'customer@forgepc.local',
                'role' => 'customer',
            ],
            [
                'name' => 'Demo Store Manager',
                'email' => 'manager@forgepc.local',
                'role' => 'store_manager',
            ],
            [
                'name' => 'Demo Inventory Staff',
                'email' => 'inventory@forgepc.local',
                'role' => 'inventory_staff',
            ],
            [
                'name' => 'Demo Technician',
                'email' => 'technician@forgepc.local',
                'role' => 'technician',
            ],
        ];

        foreach ($accounts as $account) {
            $role = DB::table('roles')
                ->where('slug', $account['role'])
                ->first();

            if (!$role) {
                continue;
            }

            $user = DB::table('users')
                ->where('email', $account['email'])
                ->first();

            if (!$user) {
                $userId = DB::table('users')->insertGetId([
                    'name' => $account['name'],
                    'email' => $account['email'],
                    'password' => Hash::make('Password123!'),
                    'email_verified_at' => now(),
                ]);
            } else {
                $userId = $user->id;
            }

            $assignmentExists = DB::table('user_roles')
                ->where('user_id', $userId)
                ->where('role_id', $role->id)
                ->exists();

            if (!$assignmentExists) {
                DB::table('user_roles')->insert([
                    'user_id' => $userId,
                    'role_id' => $role->id,
                    'assigned_by' => $admin->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
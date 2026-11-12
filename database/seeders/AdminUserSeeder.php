<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (!app()->environment(['local', 'testing'])) {
            return;
        }

        $email = env('FORGE_ADMIN_EMAIL');
        $password = env('FORGE_ADMIN_PASSWORD');

        if (!$email || !$password) {
            $this->command?->warn('Admin credentials are missing from .env.');

            return;
        }

        $role = DB::table('roles')
            ->where('slug', 'administrator')
            ->first();

        if (!$role) {
            $this->command?->error('Administrator role does not exist.');

            return;
        }

        $user = DB::table('users')
            ->where('email', $email)
            ->first();

        // Create the administrator only if the account does not exist.
        // Existing passwords are never overwritten by this seeder.
        if (!$user) {
            $userId = DB::table('users')->insertGetId([
                'name' => env('FORGE_ADMIN_NAME', 'FORGE PC Administrator'),
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);
        } else {
            $userId = $user->id;
        }

        // Bootstrap administrator assigns the initial role to itself.
        $assignmentExists = DB::table('user_roles')
            ->where('user_id', $userId)
            ->where('role_id', $role->id)
            ->exists();

        if (!$assignmentExists) {
            DB::table('user_roles')->insert([
                'user_id' => $userId,
                'role_id' => $role->id,
                'assigned_by' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
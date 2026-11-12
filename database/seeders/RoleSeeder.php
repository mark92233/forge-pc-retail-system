<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Customer',
                'slug' => 'customer',
                'description' => 'Customer accounts for shopping, custom PC builds, and repair services.',
            ],
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
                'description' => 'Full access to system administration and management.',
            ],
            [
                'name' => 'Store Manager',
                'slug' => 'store_manager',
                'description' => 'Oversees store operations, orders, inventory, and reports.',
            ],
            [
                'name' => 'Inventory Staff',
                'slug' => 'inventory_staff',
                'description' => 'Handles inventory, stock movements, and supplier records.',
            ],
            [
                'name' => 'Technician',
                'slug' => 'technician',
                'description' => 'Handles assigned diagnostics, repairs, and technical services.',
            ],
        ];

        foreach ($roles as $role) {
            $existing = DB::table('roles')
                ->where('slug', $role['slug'])
                ->first();

            if ($existing) {
                DB::table('roles')
                    ->where('id', $existing->id)
                    ->update([
                        'name' => $role['name'],
                        'description' => $role['description'],
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('roles')->insert([
                    ...$role,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
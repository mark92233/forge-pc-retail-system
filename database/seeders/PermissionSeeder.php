<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Dashboard
            ['name' => 'View Dashboard', 'slug' => 'dashboard.view', 'module' => 'dashboard', 'description' => 'Access the system dashboard.'],

            // User Management
            ['name' => 'View Users', 'slug' => 'users.view', 'module' => 'users', 'description' => 'View registered user accounts.'],
            ['name' => 'Create Users', 'slug' => 'users.create', 'module' => 'users', 'description' => 'Create new user accounts.'],
            ['name' => 'Update Users', 'slug' => 'users.update', 'module' => 'users', 'description' => 'Update user account information.'],
            ['name' => 'Deactivate Users', 'slug' => 'users.deactivate', 'module' => 'users', 'description' => 'Deactivate user accounts.'],
            ['name' => 'Assign Roles', 'slug' => 'users.assign_roles', 'module' => 'users', 'description' => 'Assign roles to user accounts.'],

            // Access Control
            ['name' => 'Manage Roles', 'slug' => 'roles.manage', 'module' => 'access_control', 'description' => 'Manage system roles.'],
            ['name' => 'Manage Permissions', 'slug' => 'permissions.manage', 'module' => 'access_control', 'description' => 'Manage system permissions.'],

            // Profile
            ['name' => 'View Own Profile', 'slug' => 'profile.view', 'module' => 'profile', 'description' => 'View personal profile.'],
            ['name' => 'Update Own Profile', 'slug' => 'profile.update', 'module' => 'profile', 'description' => 'Update personal profile.'],

            // Catalog
            ['name' => 'View Catalog', 'slug' => 'catalog.view', 'module' => 'catalog', 'description' => 'Browse the product catalog.'],
            ['name' => 'Manage Catalog', 'slug' => 'catalog.manage', 'module' => 'catalog', 'description' => 'Create, update, and manage products.'],

            // Inventory
            ['name' => 'View Inventory', 'slug' => 'inventory.view', 'module' => 'inventory', 'description' => 'View stock information.'],
            ['name' => 'Manage Inventory', 'slug' => 'inventory.manage', 'module' => 'inventory', 'description' => 'Manage stock and inventory movements.'],
            ['name' => 'Manage Suppliers', 'slug' => 'suppliers.manage', 'module' => 'inventory', 'description' => 'Manage supplier records.'],

            // PC Builder
            ['name' => 'Create Custom Builds', 'slug' => 'builds.create', 'module' => 'builder', 'description' => 'Create custom PC configurations.'],
            ['name' => 'View Own Builds', 'slug' => 'builds.view_own', 'module' => 'builder', 'description' => 'View personal PC configurations.'],
            ['name' => 'View All Builds', 'slug' => 'builds.view_all', 'module' => 'builder', 'description' => 'View all customer PC configurations.'],

            // Orders
            ['name' => 'Create Orders', 'slug' => 'orders.create', 'module' => 'orders', 'description' => 'Place product orders.'],
            ['name' => 'View Own Orders', 'slug' => 'orders.view_own', 'module' => 'orders', 'description' => 'View personal orders.'],
            ['name' => 'View All Orders', 'slug' => 'orders.view_all', 'module' => 'orders', 'description' => 'View all customer orders.'],
            ['name' => 'Manage Orders', 'slug' => 'orders.manage', 'module' => 'orders', 'description' => 'Process and manage orders.'],

            // Services
            ['name' => 'Create Service Requests', 'slug' => 'services.create', 'module' => 'services', 'description' => 'Submit repair and technical service requests.'],
            ['name' => 'View Own Service Requests', 'slug' => 'services.view_own', 'module' => 'services', 'description' => 'View personal service requests.'],
            ['name' => 'View Assigned Services', 'slug' => 'services.view_assigned', 'module' => 'services', 'description' => 'View assigned repair jobs.'],
            ['name' => 'View All Services', 'slug' => 'services.view_all', 'module' => 'services', 'description' => 'View all service requests.'],
            ['name' => 'Manage Services', 'slug' => 'services.manage', 'module' => 'services', 'description' => 'Manage service requests and assignments.'],
            ['name' => 'Update Service Progress', 'slug' => 'services.update_progress', 'module' => 'services', 'description' => 'Update repair job progress.'],
            ['name' => 'Record Diagnostics', 'slug' => 'services.diagnostics', 'module' => 'services', 'description' => 'Record diagnostic findings.'],

            // Reports
            ['name' => 'View Reports', 'slug' => 'reports.view', 'module' => 'reports', 'description' => 'Access operational reports.'],

            // Notifications
            ['name' => 'View Own Notifications', 'slug' => 'notifications.view_own', 'module' => 'notifications', 'description' => 'View personal notifications.'],

            // System
            ['name' => 'View Audit Logs', 'slug' => 'audit_logs.view', 'module' => 'system', 'description' => 'View system audit logs.'],
            ['name' => 'Manage System Settings', 'slug' => 'settings.manage', 'module' => 'system', 'description' => 'Manage system configuration.'],
        ];

        foreach ($permissions as $permission) {
            $existing = DB::table('permissions')
                ->where('slug', $permission['slug'])
                ->first();

            if ($existing) {
                DB::table('permissions')
                    ->where('id', $existing->id)
                    ->update([
                        ...$permission,
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('permissions')->insert([
                    ...$permission,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $rolePermissions = [
            'customer' => [
                'profile.view',
                'profile.update',
                'catalog.view',
                'builds.create',
                'builds.view_own',
                'orders.create',
                'orders.view_own',
                'services.create',
                'services.view_own',
                'notifications.view_own',
            ],

            'administrator' => '*',

            'store_manager' => [
                'dashboard.view',
                'users.view',
                'catalog.view',
                'catalog.manage',
                'inventory.view',
                'inventory.manage',
                'suppliers.manage',
                'builds.view_all',
                'orders.view_all',
                'orders.manage',
                'services.view_all',
                'services.manage',
                'reports.view',
                'notifications.view_own',
                'audit_logs.view',
            ],

            'inventory_staff' => [
                'dashboard.view',
                'catalog.view',
                'inventory.view',
                'inventory.manage',
                'suppliers.manage',
                'orders.view_all',
                'notifications.view_own',
            ],

            'technician' => [
                'dashboard.view',
                'services.view_assigned',
                'services.update_progress',
                'services.diagnostics',
                'notifications.view_own',
            ],
        ];

        foreach ($rolePermissions as $roleSlug => $permissionSlugs) {
            $role = DB::table('roles')
                ->where('slug', $roleSlug)
                ->first();

            if (!$role) {
                continue;
            }

            // Administrator receives every registered permission.
            if ($permissionSlugs === '*') {
                $permissionIds = DB::table('permissions')->pluck('id');
            } else {
                $permissionIds = DB::table('permissions')
                    ->whereIn('slug', $permissionSlugs)
                    ->pluck('id');
            }

            // Synchronize this role's permission assignments.
            DB::table('role_permissions')
                ->where('role_id', $role->id)
                ->delete();

            foreach ($permissionIds as $permissionId) {
                DB::table('role_permissions')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
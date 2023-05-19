<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list actions']);
        Permission::create(['name' => 'view actions']);
        Permission::create(['name' => 'create actions']);
        Permission::create(['name' => 'update actions']);
        Permission::create(['name' => 'delete actions']);

        Permission::create(['name' => 'list agrupacions']);
        Permission::create(['name' => 'view agrupacions']);
        Permission::create(['name' => 'create agrupacions']);
        Permission::create(['name' => 'update agrupacions']);
        Permission::create(['name' => 'delete agrupacions']);

        Permission::create(['name' => 'list prioridads']);
        Permission::create(['name' => 'view prioridads']);
        Permission::create(['name' => 'create prioridads']);
        Permission::create(['name' => 'update prioridads']);
        Permission::create(['name' => 'delete prioridads']);

        Permission::create(['name' => 'list status']);
        Permission::create(['name' => 'view status']);
        Permission::create(['name' => 'create status']);
        Permission::create(['name' => 'update status']);
        Permission::create(['name' => 'delete status']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        Permission::create(['name' => 'view company']);
        Permission::create(['name' => 'create company']);
        Permission::create(['name' => 'edit company']);
        Permission::create(['name' => 'delete company']);

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $viewer = Role::create(['name' => 'viewer']);

        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all());
        $editor->givePermissionTo(['view company', 'create company', 'edit company']);
        $viewer->givePermissionTo(['view company']);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of permissions
        $permissions = [
            'view dashboard',

            'view users',
            'create users',
            'edit users',
            'delete users',

            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            'view permissions',
            'create permissions',
            'delete permissions',

            'view menus',
            'create menus',
            'edit menus',
            'delete menus',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $editorRole = Role::firstOrCreate(['name' => 'Editor']);
        $viewerRole = Role::firstOrCreate(['name' => 'Viewer']);

        // Assign all permissions to Admin
        $adminRole->givePermissionTo(Permission::all());

        // Assign limited permissions to Editor
        $editorRole->givePermissionTo([
            'view dashboard',

            'view users',
            'create users',
            'edit users',

            'view roles',
            'create roles',
            'edit roles',

            'view permissions',
            'create permissions',

            'view menus',
            'create menus',
            'edit menus',
        ]);

        // Assign limited (read-only) permissions to Viewer
        $viewerRole->givePermissionTo([
            'view dashboard',
            'view users',
            'view roles',
            'view permissions',
            'view menus',
        ]);
    }
}

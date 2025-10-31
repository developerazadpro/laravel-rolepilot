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
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Assign all permissions to Admin
        $adminRole->givePermissionTo(Permission::all());

        // Assing limited permissions to User
        $userRole->givePermissionTo(['view dashboard']);
    }
}

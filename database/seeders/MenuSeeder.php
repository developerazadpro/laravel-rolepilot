<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create top-level menu items
        $dashboard = Menu::create([
            'name'  => 'Dashboard',
            'route' => 'dashboard',
            'icon'  => 'dashboard',
            'order' => 1,
            'permission_name' => 'view dashboard', // required
        ]);

        $users = Menu::create([
            'name'  => 'Users',
            'route' => 'admin.users.index',
            'icon'  => 'users',
            'order' => 2,
            'permission_name' => 'view users', // required
        ]);

        $roles = Menu::create([
            'name'  => 'Roles',
            'route' => 'admin.roles.index',
            'icon'  => 'roles',
            'order' => 3,
            'permission_name' => 'view roles', // required
        ]);

        $permissions = Menu::create([
            'name'  => 'Permissions',
            'route' => 'admin.permissions.index',
            'icon'  => 'permissions',
            'order' => 4,
            'permission_name' => 'view permissions', // required
        ]);

        $menus = Menu::create([
            'name'  => 'Menu',
            'route' => 'admin.menus.index',
            'icon'  => 'menus',
            'order' => 5,
            'permission_name' => 'view menus', // required
        ]);

        $logs = Menu::create([
            'name'  => 'Audit Logs',
            'route' => 'admin.logs.index',
            'icon'  => 'logs',
            'order' => 6,
            'permission_name' => 'view logs', // required
        ]);


        // 2. Get the Admin role from the database
        $adminRole = Role::where('name', 'Admin')->first();

        // 3. Attach menus to the Admin role
        $dashboard->roles()->attach($adminRole);
        $users->roles()->attach($adminRole);
        $roles->roles()->attach($adminRole);
        $permissions->roles()->attach($adminRole);
        $menus->roles()->attach($adminRole);
        $logs->roles()->attach($adminRole);
    }
}

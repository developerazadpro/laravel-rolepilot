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
        ]);

        $users = Menu::create([
            'name'  => 'Users',
            'route' => 'users.index',
            'icon'  => 'users',
            'order' => 2,
        ]);

        $roles = Menu::create([
            'name'  => 'Roles',
            'route' => 'roles.index',
            'icon'  => 'roles',
            'order' => 3,
        ]);

        $permissions = Menu::create([
            'name'  => 'Permissions',
            'route' => 'permissions.index',
            'icon'  => 'permissions',
            'order' => 4,
        ]);

        // 2. Get the Admin role from the database
        $adminRole = Role::where('name', 'Admin')->first();

        // 3. Attach menus to the Admin role
        $dashboard->roles()->attach($adminRole);
        $users->roles()->attach($adminRole);
        $roles->roles()->attach($adminRole);
        $permissions->roles()->attach($adminRole);
    }
}

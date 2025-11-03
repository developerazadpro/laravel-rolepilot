<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Register role & permission seeder
        $this->call(RolePermissionSeeder::class);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $editor = User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $viewer = User::factory()->create([
            'name' => 'Viewer',
            'email' => 'viewer@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        // Assign roles to users
        $admin->assignRole('Admin');
        $editor->assignRole('Editor');
        $viewer->assignRole('Viewer');

        // Create Menus Seeder
        $this->call(MenuSeeder::class);
    }
}

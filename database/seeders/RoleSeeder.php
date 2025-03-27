<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Get all permissions
        $permissions = Permission::all();

        // If no permissions exist, create them first
        if ($permissions->isEmpty()) {
            $this->call(PermissionSeeder::class);
            $permissions = Permission::all();
        }

        // Assign all permissions to admin role
        $adminRole->syncPermissions($permissions);

        $this->command->info('Admin role created with all permissions!');
    }
}
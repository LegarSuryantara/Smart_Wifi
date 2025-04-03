<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Default permissions for the application
     * 
     * @var array
     */
    protected $defaultPermissions = [
        // User permissions
        'view users',
        'create users',
        'edit users',
        'delete users',
        
        // Role permissions
        'view roles',
        'create roles',
        'edit roles',
        'delete roles',
        
        // Permission permissions
        'view permissions',
        'create permissions',
        'edit permissions',
        'delete permissions',
        
        // Pakets permissions
        'view pakets',
        'edit pakets',
        'create pakets',
        'delete pakets',

        // Users permissions
        'user-access',
        
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->defaultPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        
        $this->command->info('Default permissions seeded successfully!');
    }
}
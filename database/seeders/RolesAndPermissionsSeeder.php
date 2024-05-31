<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'Add Cart']);
        Permission::create(['name' => 'CheckOut']);
        Permission::create(['name' => 'Ban User']);
        Permission::create(['name' => 'Add Product and Category']);

        // or may be done by chaining
        $role = Role::create(['name' => 'user'])
            ->givePermissionTo(['Add Cart', 'CheckOut']);

        // $role = Role::create(['name' => 'super-admin']);
        // $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo(['Ban User', 'Add Product and Category']);
    }
}

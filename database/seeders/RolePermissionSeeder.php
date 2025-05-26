<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::create(['name' => 'create Product']);
        Permission::create(['name' => 'edit Product']);
        Permission::create(['name' => 'delete Product']);

        $admin = Role::findByName('admin');
        $cashier  = Role::create(['name' => 'cashier']);

        $admin->givePermissionTo(['create Product', 'edit Product', 'delete Product']);
        $cashier->givePermissionTo(['create Product']);
    }
}

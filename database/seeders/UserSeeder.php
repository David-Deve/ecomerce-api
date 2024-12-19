<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRole = Role::firstOrcreate(['name' => 'admin']);

        $adminUser = User::firstOrcreate([
            'email' => 'admin@admin.com',
        ],[
            'name' => 'Admin',
            'password' => Hash::make('123456'),
        ]);
        $adminUser->assignRole($adminRole);
    }
}

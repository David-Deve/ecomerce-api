<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $productgroup=[
            ['name'=>'Drink'],
            ['name'=>'Snake'],
            ['name'=>'Alcohol'],
            ['name'=>'accessory'],
        ];
        foreach ($productgroup as $productgroups){
            ProductGroup::create($productgroups);
        }
        $product=[
            ['name'=>'sting','price'=>'0.5','qty'=>'100','group_id'=>1],
            ['name'=>'fanta','price'=>'0.5','qty'=>'100','group_id'=>1],
            ['name'=>'coca','price'=>'0.5','qty'=>'100','group_id'=>1],
            ['name'=>'prime','price'=>'0.5','qty'=>'100','group_id'=>1],
            ['name'=>'redbull','price'=>'0.5','qty'=>'100','group_id'=>1],
            ['name'=>'monster','price'=>'0.5','qty'=>'100','group_id'=>1],
            ['name'=>'cafe','price'=>'0.5','qty'=>'100','group_id'=>1],
            ['name'=>'poca','price'=>'0.5','qty'=>'100','group_id'=>1],
        ];
        foreach ($product as $products){
            Product::create($products);
        }

        Permission::create(['name' => 'create Product']);
        Permission::create(['name' => 'edit Product']);
        Permission::create(['name' => 'delete Product']);

        $admin = Role::create(['name' => 'admin']);
        $cashier  = Role::create(['name' => 'cashier']);

        $admin->givePermissionTo(['create Product', 'edit Product', 'delete Product']);
        $cashier->givePermissionTo(['create Product']);

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

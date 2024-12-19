<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
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
    }
}

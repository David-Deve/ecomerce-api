<?php

namespace Database\Seeders;

use App\Models\ProductGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productgroup=[
            ['name'=>'Drink'],
            ['name'=>'Snake'],
            ['name'=>'Alcohol'],
            ['name'=>'accessory'],
        ];
        foreach ($productgroup as $productgroups){
            ProductGroup::create($productgroups);
        }
    }
}

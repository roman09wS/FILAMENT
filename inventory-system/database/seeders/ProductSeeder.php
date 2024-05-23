<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'code' => 1001,
            'name' => 'Leche',
            'price' => 0,
        ]);

        Product::create([
            'code' => 1002,
            'name' => 'Arroz',
            'price' => 0,
        ]);

        Product::create([
            'code' => 1003,
            'name' => 'Azucar',
            'price' => 0,
        ]);


    }
}

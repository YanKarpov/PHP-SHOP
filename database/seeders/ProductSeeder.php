<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'test',
                'description' => 'testdesc',
                'price' => 123,
                'stock' => 10,
            ],
            [
                'name' => 'test2',
                'description' => 'testdesc',
                'price' => 123,
                'stock' => 5,
            ],
            [
                'name' => 'test3',
                'description' => 'testdesc',
                'price' => 123,
                'stock' => 0,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

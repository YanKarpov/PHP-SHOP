<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Пример товара 1111',
                'description' => 'Типо описание',
                'price' => 999.99,
                'quantity' => 10,
            ],
            [
                'name' => 'Пример товара 2',
                'description' => 'Ещё описание', 
                'price' => 2499.50,
                'quantity' => 5,
            ],
            [
                'name' => 'Товар 3',
                'description' => 'Еще один товар',
                'price' => 500.00,
                'quantity' => 20,
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}

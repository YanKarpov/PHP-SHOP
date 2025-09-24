<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Пример продукта 1',
            'description' => 'Описание первого тестового продукта',
            'price' => 99.99
        ]);

        Product::create([
            'name' => 'Пример продукта 2', 
            'description' => 'Описание второго тестового продукта',
            'price' => 149.99
        ]);

        Product::create([
            'name' => 'Пример продукта 3',
            'description' => 'Описание третьего тестового продукта',
            'price' => 199.99
        ]);
    }
}
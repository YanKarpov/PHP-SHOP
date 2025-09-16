<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Электроника', 'slug' => 'electronics'],
            ['name' => 'Одежда', 'slug' => 'clothing'],
            ['name' => 'Книги', 'slug' => 'books'],
            ['name' => 'Спорт', 'slug' => 'sports'],
            ['name' => 'Дом и сад', 'slug' => 'home-garden'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('menu_items')->truncate();

        $menuItems = [
            [
                'title' => 'Главная',
                'url' => '/',
                'is_active' => true,
                'sort_order' => 1,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Каталог',
                'url' => '/catalog',
                'is_active' => true,
                'sort_order' => 2,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Все товары',
                'url' => '/catalog/all',
                'is_active' => true,
                'sort_order' => 1,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Акции',
                'url' => '/catalog/sale',
                'is_active' => true,
                'sort_order' => 2,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'О нас',
                'url' => '/about',
                'is_active' => true,
                'sort_order' => 3,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Контакты',
                'url' => '/contacts',
                'is_active' => true,
                'sort_order' => 4,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('menu_items')->insert($menuItems);
    }
}
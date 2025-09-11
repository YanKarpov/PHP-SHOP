<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemsSeeder extends Seeder
{
    public function run()
    {
        $menuItems = [
            [
                'title' => 'Главная',
                'url' => '/',
                'sort_order' => 1
            ],
            [
                'title' => 'Каталог',
                'url' => '/catalog',
                'sort_order' => 2,
                'children' => [
                    ['title' => 'Все товары', 'url' => '/catalog/all', 'sort_order' => 1],
                    ['title' => 'Акции', 'url' => '/catalog/sale', 'sort_order' => 2],
                    ['title' => 'Новинки', 'url' => '/catalog/new', 'sort_order' => 3],
                ]
            ],
            [
                'title' => 'О нас',
                'url' => '/about',
                'sort_order' => 3
            ],
            [
                'title' => 'Контакты',
                'url' => '/contacts',
                'sort_order' => 4
            ]
        ];

        foreach ($menuItems as $itemData) {
            $children = $itemData['children'] ?? null;
            unset($itemData['children']);
            
            $menuItem = MenuItem::create($itemData);
            
            if ($children) {
                foreach ($children as $childData) {
                    $childData['parent_id'] = $menuItem->id;
                    MenuItem::create($childData);
                }
            }
        }
    }
}
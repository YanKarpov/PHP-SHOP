<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run()
    {
        Banner::create([
            'title' => 'Скидка 120% на все товары для студентов IThub',
            'description' => 'Только этой семестр получите скидку 120% на весь проезд',
            'image_url' => 'https://vizitspb.ru/wp-content/uploads/2025/05/podorozhnik-terminal.jpg',
            'link_url' => '/promo/sale20',
            'position' => 1,
            'is_active' => true
        ]);

        Banner::create([
            'title' => 'Бесплатная доставка',
            'description' => 'Бесплатная доставка при заказе от 5000 рублей',
            'image_url' => 'https://example.com/banner2.jpg',
            'link_url' => '/delivery',
            'position' => 2,
            'is_active' => true
        ]);

        Banner::create([
            'title' => 'Новая коллекция',
            'description' => 'Ознакомьтесь с новой осенней коллекцией',
            'image_url' => 'https://example.com/banner3.jpg',
            'link_url' => '/new-collection',
            'position' => 3,
            'is_active' => true
        ]);
    }
}
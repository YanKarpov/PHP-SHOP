<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class BannerSeeder extends Seeder

{
    public function run()
    {
         // Создаем папку для баннеров если не существует
         if (!Storage::disk('public')->exists('banners')) {
            Storage::disk('public')->makeDirectory('banners');
        }
        Banner::create([
            'title' => 'Скидка 120% на все товары для студентов IThub',
            'description' => 'Только этой семестр получите скидку 120% на весь проезд',
            'image_url' => 'images/podorozhnik-terminal.jpg',
            'link_url' => 'https://ithub.ru/',
            'position' => 1,
            'target' => '_self',
            'position' => 1,
            'type' => 'main',
            'is_active' => true,
            'start_date' => now(),
            'end_date' => now()->addWeek()
        ]);

        Banner::create([
            'title' => 'Комару сидит на БАНКАХ???',
            'description' => 'это просто шок контент',
            'image_url' => 'images/komaru.jpg',
            'link_url' => 'https://ru.pinterest.com/2komaru2/%D0%BA%D0%BE%D0%BC%D0%B0%D1%80%D1%83/',
            'position' => 2,
            'target' => '_self',
            'position' => 1,
            'type' => 'main',
            'is_active' => true,
            'start_date' => now(),
            'end_date' => now()->addWeek()
        ]);

        Banner::create([
            'title' => 'хочешь быть таким как он?',
            'description' => 'а сколько шариков лопнул ты?',
            'image_url' => 'images/btd.png',
            'link_url' => 'https://ru.wikipedia.org/wiki/Bloons_Tower_Defense',
            'position' => 3,
            'target' => '_self',
            'position' => 1,
            'type' => 'main',
            'is_active' => true,
            'start_date' => now(),
            'end_date' => now()->addWeek()
        ]);
        foreach ($banners as $bannerData) {
            Banner::create($bannerData);
        }
    }
}
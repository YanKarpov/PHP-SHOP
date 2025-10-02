<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::factory()->create([
            'name' => 'Магазин Центральный',
            'street' => 'ул. Ленина, 10',
            'city' => 'Москва',
            'postal_code' => '101000',
            'phone' => '+7 (495) 123-45-67',
            'email' => 'central@store.ru',
            'map_url' => 'https://yandex.ru/maps/?text=Москва, ул. Ленина, 10',
            'working_hours' => [
                'Пн-Пт' => '10:00–20:00',
                'Сб' => '11:00–19:00',
                'Вс' => 'выходной',
            ],
            'is_active' => true,
        ]);

        Store::factory()->create([
            'name' => 'Магазин Северный',
            'street' => 'пр. Победы, 25',
            'city' => 'Москва',
            'postal_code' => '102000',
            'phone' => '+7 (495) 987-65-43',
            'email' => 'north@store.ru',
            'map_url' => 'https://yandex.ru/maps/?text=Москва, пр. Победы, 25',
            'working_hours' => [
                'Пн-Пт' => '09:00–21:00',
                'Сб' => '10:00–20:00',
                'Вс' => '12:00–18:00',
            ],
            'is_active' => true,
        ]);

        Store::factory(3)->create();
    }
}

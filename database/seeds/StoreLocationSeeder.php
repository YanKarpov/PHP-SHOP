\
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreLocationSeeder extends Seeder
{
    public function run()
    {
        DB::table('store_locations')->insert([
            [
                'name' => 'ТРЦ Невский, 3 этаж',
                'city' => 'Санкт-Петербург',
                'address' => 'Невский пр., 1',
                'phone' => '+7 812 000-00-00',
                'email' => 'nevsky@shop.local',
                'lat' => 59.935, 'lng' => 30.325,
                'hours' => json_encode(['mon'=>'10:00-22:00','tue'=>'10:00-22:00','wed'=>'10:00-22:00','thu'=>'10:00-22:00','fri'=>'10:00-22:00','sat'=>'10:00-23:00','sun'=>'10:00-21:00']),
                'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'TC Golden Mile',
                'city' => 'Москва',
                'address' => 'Тверская, 5',
                'phone' => '+7 495 111-11-11',
                'email' => 'moscow@shop.local',
                'lat' => 55.757, 'lng' => 37.615,
                'hours' => json_encode(['mon'=>'10:00-22:00','tue'=>'10:00-22:00','wed'=>'10:00-22:00','thu'=>'10:00-22:00','fri'=>'10:00-22:00','sat'=>'10:00-23:00','sun'=>'11:00-21:00']),
                'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ]
        ]);
    }
}

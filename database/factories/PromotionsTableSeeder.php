<?php

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    public function run()
    {
        Promotion::factory()->count(5)->create();
    }
}
// <?p
// ...

// Чтобы увидеть весь текст, нажмите на кнопку *Развернуть весь ответ* ⬇️
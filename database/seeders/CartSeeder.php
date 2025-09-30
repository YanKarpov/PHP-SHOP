<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        CartItem::truncate();
        Cart::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Создаем тестовую корзину для гостя
        $guestCart = Cart::create([
            'session_id' => 'test-session-001'
        ]);

        // Добавляем случайные товары в корзину гостя
        $products = Product::inRandomOrder()->limit(3)->get();
        
        foreach ($products as $product) {
            CartItem::create([
                'cart_id' => $guestCart->id,
                'product_id' => $product->id,
                'quantity' => rand(1, 3),
                'price' => $product->price
            ]);
        }

        $this->command->info('Создана тестовая корзина с товарами!');
    }
}

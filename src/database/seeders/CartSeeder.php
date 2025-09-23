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
        // Сначала создаем корзину
        $cart = Cart::create([
            'session_id' => 'test-session-123'
        ]);

        // Получаем несколько товаров
        $products = Product::limit(3)->get();

        // Проверяем что товары есть
        if ($products->count() > 0) {
            // Добавляем товары в корзину
            foreach ($products as $product) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3),
                    'price' => $product->price
                ]);
            }
            
            $this->command->info('Создана тестовая корзина с ' . $products->count() . ' товарами!');
        } else {
            $this->command->error('Нет товаров для добавления в корзину! Сначала запусти ProductSeeder.');
        }
    }
}
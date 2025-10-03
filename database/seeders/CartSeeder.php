<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

class CartSeeder extends Seeder
{
    public function run()
    {
        // Создаем тестового пользователя если нет
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Создаем тестовые продукты если нет
        $products = Product::take(3)->get();
        if ($products->count() === 0) {
            $products = Product::factory()->count(3)->create();
        }

        // Создаем корзину для пользователя
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['session_id' => null]
        );

        // Добавляем товары в корзину
        foreach ($products as $product) {
            CartItem::firstOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_id' => $product->id
                ],
                [
                    'quantity' => rand(1, 3),
                    'price' => $product->price ?? rand(100, 1000),
                ]
            );
        }

        $this->command->info("Created cart with {$products->count()} items for user {$user->name}");
    }
}
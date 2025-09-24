<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Создаем одобренные отзывы
            $this->createReviews($product, rand(3, 8), true);
            
            // Создаем отзывы на модерации
            $this->createReviews($product, rand(1, 3), false);
        }
    }

    private function createReviews(Product $product, int $count, bool $approved)
    {
        for ($i = 0; $i < $count; $i++) {
            Review::create([
                'product_id' => $product->id,
                'author_name' => fake()->name(),
                'author_email' => fake()->safeEmail(),
                'rating' => rand(1, 5),
                'comment' => fake()->paragraph(3),
                'is_approved' => $approved,
            ]);
        }
    }
}
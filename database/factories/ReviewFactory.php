<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'author_name' => $this->faker->name,
            'author_email' => $this->faker->safeEmail,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph(3),
            'is_approved' => $this->faker->boolean(80), // 80% chance of being approved
        ];
    }
}
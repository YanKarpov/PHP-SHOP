<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Список всех продуктов
    public function index()
    {
        $products = Product::withCount(['reviews as approved_reviews_count' => function($query) {
                $query->where('is_approved', true);
            }])
            ->withAvg(['reviews as average_rating' => function($query) {
                $query->where('is_approved', true);
            }], 'rating')
            ->get();

        return view('products.index', compact('products'));
    }

    // Страница конкретного продукта с отзывами
    public function show(Product $product)
    {
        $reviews = $product->reviews()
            ->approved()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('products.show', compact('product', 'reviews'));
    }
}
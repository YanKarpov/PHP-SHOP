<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    // Получение отзывов для продукта
    public function index(Product $product)
    {
        $reviews = Review::with('product')
            ->forProduct($product->id)
            ->approved()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reviews.index', compact('product', 'reviews'));
    }

    // Сохранение нового отзыва
    public function store(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Review::create([
            'product_id' => $product->id,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false // Требует модерации
        ]);

        return redirect()->back()
            ->with('success', 'Ваш отзыв отправлен на модерацию. Спасибо!');
    }

    // Для админ-панели - список всех отзывов
    public function adminIndex()
    {
        $reviews = Review::with('product')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    // Одобрение отзыва
    public function approve(Review $review)
    {
        $review->update(['is_approved' => true]);

        return redirect()->back()
            ->with('success', 'Отзыв одобрен');
    }

    // Удаление отзыва
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()
            ->with('success', 'Отзыв удален');
    }
}
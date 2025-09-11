<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session('admin')) {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    // Список всех отзывов для модерации
    public function index()
    {
        $reviews = Review::with('product')
            ->orderBy('is_approved')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    // Одобрение отзыва
    public function approve(Review $review)
    {
        $review->update(['is_approved' => true]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв одобрен');
    }

    // Отклонение отзыва
    public function reject(Review $review)
    {
        $review->update(['is_approved' => false]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв отклонен');
    }

    // Удаление отзыва
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв удален');
    }

    // Просмотр отзыва
    public function show(Review $review)
    {
        return view('admin.reviews.show', compact('review'));
    }
}
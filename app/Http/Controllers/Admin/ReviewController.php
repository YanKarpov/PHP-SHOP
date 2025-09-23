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

    public function index()
    {
        $reviews = Review::with('product')
            ->orderBy('is_approved')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $review->update(['is_approved' => true]);
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв одобрен');
    }

    public function reject(Review $review)
    {
        $review->update(['is_approved' => false]);
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв отклонен');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв удален');
    }

    public function show(Review $review)
    {
        return view('admin.reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|min:10|max:1000',
            'is_approved' => 'sometimes|boolean'
        ]);

        $review->update($validated);
        return redirect()->route('admin.reviews.show', $review)->with('success', 'Отзыв успешно обновлен');
    }
}
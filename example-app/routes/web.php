<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;

// Главная страница с продуктами
Route::get('/', [ProductController::class, 'index'])->name('home');

// Страница продукта с отзывами
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Маршруты для отзывов
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])
    ->name('reviews.store');

// Группа роутов для админ-панели
Route::prefix('admin')->name('admin.')->group(function () {
    // Модерация отзывов
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/edit', [AdminReviewController::class, 'edit'])->name('reviews.edit');
    Route::patch('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::patch('/reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
    Route::put('/reviews/{review}', [AdminReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Простая аутентификация для демо
Route::get('/login', function () {
    return view('simple-auth');
})->name('login');

Route::post('/login', function (Request $request) {
    if ($request->password === 'admin123') {
        session(['admin' => true]);
        return redirect()->route('admin.reviews.index');
    }
    return back()->with('error', 'Неверный пароль');
});

// Выход
Route::post('/logout', function () {
    session()->forget('admin');
    return redirect()->route('home');
})->name('logout');
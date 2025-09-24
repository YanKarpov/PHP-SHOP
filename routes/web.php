<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\AdminProductController;

use App\Http\Controllers\AdThesisController;

// Главная страница
Route::get('/', [ProductController::class, 'index'])->name('home');

// Страница продукта с отзывами
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Маршруты отзывов
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Маршрут для ad-theses
Route::get('/ad-theses', [AdThesisController::class, 'index']);

// Админ-панель
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/edit', [AdminReviewController::class, 'edit'])->name('reviews.edit');
    Route::patch('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::patch('/reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
    Route::put('/reviews/{review}', [AdminReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Простая аутентификация для демо
Route::get('/login', fn() => view('simple-auth'))->name('login');
Route::post('/login', function (Request $request) {
    if ($request->password === 'admin123') {
        session(['admin' => true]);
        return redirect()->route('admin.reviews.index');
    }
    return back()->with('error', 'Неверный пароль');
});

// Выход
Route::post('/logout', fn() => redirect()->route('home'))->name('logout');


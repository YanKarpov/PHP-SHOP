<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\AdThesisController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\CartController;


// Главная страница - продукты
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');


// Страница меню
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Маршруты продукта с отзывами
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Маршрут для ad-theses
Route::get('/ad-theses', [AdThesisController::class, 'index']);

// Новости
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// Простая аутентификация для демо
Route::get('/login', fn() => view('simple-auth'))->name('login');
Route::post('/login', function (Request $request) {
    if ($request->password === 'admin123') {
        session(['admin' => true]);
        return redirect()->route('admin.reviews.index');
    }
    return back()->with('error', 'Неверный пароль');
});
Route::post('/logout', fn() => redirect()->route('home'))->name('logout');

// Админ-панель
Route::prefix('admin')->name('admin.')->group(function () {
    // Продукты
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // Отзывы
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/edit', [AdminReviewController::class, 'edit'])->name('reviews.edit');
    Route::patch('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::patch('/reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
    Route::put('/reviews/{review}', [AdminReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

    if (app()->environment('local')) {
        Route::get('/news', [NewsAdminController::class, 'index'])->name('news.index');
        Route::get('/news/create', [NewsAdminController::class, 'create'])->name('news.create');
        Route::post('/news', [NewsAdminController::class, 'store'])->name('news.store');
        Route::get('/news/{id}/edit', [NewsAdminController::class, 'edit'])->name('news.edit');
        Route::put('/news/{id}', [NewsAdminController::class, 'update'])->name('news.update');
        Route::delete('/news/{id}', [NewsAdminController::class, 'destroy'])->name('news.destroy');
    }

    // Меню
    Route::resource('menu', AdminMenuController::class);
});



// Страница для тестирования корзины






Route::prefix('cart')->group(function () {
    Route::get('/test', [CartController::class, 'test'])->name('cart.test');
    Route::post('/{item}/increase', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/{item}/decrease', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::put('/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');

});


// Route::post('/cart/{item}/increase', [CartController::class, 'increase'])->name('cart.increase');
// Route::post('/cart/{item}/decrease', [CartController::class, 'decrease'])->name('cart.decrease');
// Route::put('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
// Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
// Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
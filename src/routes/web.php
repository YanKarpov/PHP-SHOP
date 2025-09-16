<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminProductController;

// Публичные маршруты
Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/preview-products', [ProductController::class, 'index']);

// Админ-панель ТОЛЬКО для товаров
Route::prefix('admin/products')->name('admin.products.')->group(function () {
    
    // Главная страница админки - список товаров
    Route::get('/', [AdminProductController::class, 'index'])->name('index');
    
    // Создание товара
    Route::get('/create', [AdminProductController::class, 'create'])->name('create');
    Route::post('/', [AdminProductController::class, 'store'])->name('store');
    
    // Просмотр товара
    Route::get('/{product}', [AdminProductController::class, 'show'])->name('show');
    
    // Редактирование товара
    Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
    Route::put('/{product}', [AdminProductController::class, 'update'])->name('update');
    
    // Удаление товара
    Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('destroy');
    
    // Изменение статуса
    Route::post('/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])
         ->name('toggle-status');
});
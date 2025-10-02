<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Публичные категории (frontend)
Route::get('/shop/categories', [CategoryController::class, 'index'])->name('categories.index');

// Админ-панель
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('categories', [AdminController::class, 'categories'])->name('categories.index');
    Route::get('categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::post('categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('categories/{id}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
});

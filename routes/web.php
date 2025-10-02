<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\Admin\PromotionAdminController;

// Главная
Route::get('/', function () {
    return view('welcome');
});

// Публичные акции
Route::get('/promotions', [PromotionsController::class, 'index'])
    ->name('promotions.index');

// // Админка
// Route::prefix('/admin')->name('admin.')->group(function () {
//     Route::resource('promotions', PromotionAdminController::class);
// });
// routes/web.php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('promotions', PromotionAdminController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('promotions', \App\Http\Controllers\Admin\PromotionAdminController::class);
});

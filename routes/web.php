<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use Illuminate\Support\Facades\Route;

// Главная страница с баннерами
Route::get('/', [BannerController::class, 'showHomepage'])->name('home');

// API для получения баннеров
Route::get('/api/banners', [BannerController::class, 'getActiveBanners'])->name('banners.api');

// Админ-панель баннеров
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('banners', AdminBannerController::class);
});
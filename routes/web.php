<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;

// Главная страница с баннерами
Route::get('/', [BannerController::class, 'showHomepage'])->name('home');

// API для баннеров
Route::get('/api/banners', [BannerController::class, 'getActiveBanners'])->name('banners.api');
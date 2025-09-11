<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/menu', [MenuController::class, 'getMenu'])->name('menu.show');

Route::get('/api/menu', [MenuController::class, 'getMenuData'])->name('menu.api');
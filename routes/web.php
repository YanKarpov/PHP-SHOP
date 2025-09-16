<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/menu', [MenuController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('menu', AdminMenuController::class);
});

Route::redirect('/', '/menu');

<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminStoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', [StoreController::class, 'index'])->name('stores.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('stores', AdminStoreController::class);
});

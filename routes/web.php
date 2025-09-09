<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\MenuController;

Route::get('/menu', [MenuController::class, 'index']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromotionsController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/promotions', function () {
    return view('promotions');
});

use App\Models\Promotion;

Route::get('/promotions', function () {
    $promotions = Promotion::all(); // Получаем все акции из БД
    return view('promotions', compact('promotions'));
});

use Illuminate\Support\Collection;

Route::get('/promotions', function () {
    $promotions = collect([
        (object)[
            'title' => 'Супер скидка',
            'discount_percentage' => 20,
            'description' => 'Только сегодня!'
        ]
    ]);
    return view('promotions', compact('promotions'));
});

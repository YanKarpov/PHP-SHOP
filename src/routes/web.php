<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/preview-products', function () {
    $products = \App\Models\Product::all();
    return view('products', compact('products'));
});
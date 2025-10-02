<?php

use Illuminate\Support\Facades\Route;

// Несколько маршрутов для блока контактов
Route::prefix('contacts')->group(function () {
    // Список
    Route::get('/', 'StoreLocationController@index')->name('contacts.index');
    // Просмотр одной точки (Route Model Binding по id)
    Route::get('/{location}', 'StoreLocationController@show')->name('contacts.show');
});

// JSON-эндпоинт
Route::get('/api/contacts', 'StoreLocationController@json')->name('contacts.json');

\
<?php

// PUBLIC (Laravel 7 style)
Route::prefix('contacts')->group(function () {
    Route::get('/', 'StoreLocationController@index')->name('contacts.index');
    Route::get('/{location}', 'StoreLocationController@show')->name('contacts.show');
});
Route::get('/api/contacts', 'StoreLocationController@json')->name('contacts.json');

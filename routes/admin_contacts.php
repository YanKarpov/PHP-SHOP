\
<?php

// ADMIN (Laravel 7 style, без аутентификации по умолчанию)
Route::prefix('admin/contacts')->name('admin.contacts.')->group(function () {
    Route::get('/', 'Admin\StoreLocationAdminController@index')->name('index');
    Route::get('/create', 'Admin\StoreLocationAdminController@create')->name('create');
    Route::post('/', 'Admin\StoreLocationAdminController@store')->name('store');
    Route::get('/{location}/edit', 'Admin\StoreLocationAdminController@edit')->name('edit');
    Route::put('/{location}', 'Admin\StoreLocationAdminController@update')->name('update');
    Route::delete('/{location}', 'Admin\StoreLocationAdminController@destroy')->name('destroy');
});

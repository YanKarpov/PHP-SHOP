\
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreLocationControllerL8;

Route::prefix('contacts')->group(function () {
    Route::get('/', [StoreLocationControllerL8::class, 'index'])->name('contacts.index');
    Route::get('/{location}', [StoreLocationControllerL8::class, 'show'])->name('contacts.show');
});
Route::get('/api/contacts', [StoreLocationControllerL8::class, 'json'])->name('contacts.json');

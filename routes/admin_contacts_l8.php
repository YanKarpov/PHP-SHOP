\
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StoreLocationAdminController;

Route::prefix('admin/contacts')->name('admin.contacts.')->group(function () {
    Route::get('/', [StoreLocationAdminController::class, 'index'])->name('index');
    Route::get('/create', [StoreLocationAdminController::class, 'create'])->name('create');
    Route::post('/', [StoreLocationAdminController::class, 'store'])->name('store');
    Route::get('/{location}/edit', [StoreLocationAdminController::class, 'edit'])->name('edit');
    Route::put('/{location}', [StoreLocationAdminController::class, 'update'])->name('update');
    Route::delete('/{location}', [StoreLocationAdminController::class, 'destroy'])->name('destroy');
});

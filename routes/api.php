<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


use App\Http\Controllers\ReviewController;
Route::prefix('products/{product}')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index']);
    Route::get('/rating', [ReviewController::class, 'getProductRating']);
    Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth:api');
});

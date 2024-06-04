<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('products', [ProductController::class, 'getListProducts']);
    Route::post('products', [ProductController::class, 'createProduct']);
    Route::put('products', [ProductController::class, 'updateProduct']);
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::resource('products', ProductController::class);
// });

<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\RecommendedProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function() {

    Route::prefix('categories')->group(function () {
        Route::get('{id}', [CategoriesController::class, 'get']);
        Route::post('/', [CategoriesController::class, 'add']);
        Route::put('{id}', [CategoriesController::class, 'update']);
    });

    Route::prefix('products')->group(function () {
        Route::get('{id}', [ProductsController::class, 'get']);
        Route::post('/', [ProductsController::class, 'add']);
        Route::put('{id}', [ProductsController::class, 'update']);
        Route::Delete('{id}', [ProductsController::class, 'delete']);
    });

    Route::get('recommended-products', [RecommendedProductsController::class, 'get']);
});

<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\User\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories',[CategoriesController::class, 'index']);
Route::get('categories/{id}',[CategoriesController::class, 'show']);

Route::get('products',[ProductController::class, 'index']);
Route::get('products/{id}',[ProductController::class, 'show']);

Route::get('/cart', [CartController::class,'getCart']);
Route::post('/cart/add-item', [CartController::class,'addToCart']);
Route::post('/cart/remove-item', [CartController::class,'removeItem']);
Route::post('/cart/update-item', [CartController::class,'updateItem']);


<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('logout', [LoginController::class, 'destroy'])->name('admin.destroy');

//======================== Start Categories =================================================================

    Route::resource('category', CategoryController::class);

//======================== end Products =================================================================

//======================== Start Products =================================================================

Route::resource('product', ProductController::class);

//======================== end Categories =================================================================
});

//======================== Start Login =================================================================
Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('get.admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
});

//======================== End Categories =================================================================

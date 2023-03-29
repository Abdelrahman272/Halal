<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AskController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PolicyController;
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
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::put('categories/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('category.force-delete');

    //======================== end Products =================================================================



    //======================== Start Products =================================================================

    Route::resource('product', ProductController::class);

    //======================== end Categories =================================================================



    //======================== Start City =================================================================

    Route::resource('city', CityController::class);

    //======================== end City =================================================================



    //======================== Start policy =================================================================

    Route::resource('policy', PolicyController::class);

    //======================== end policy =================================================================


    //======================== Start About us =================================================================

    Route::resource('contact', ContactController::class);

    //======================== end About us =================================================================


    //======================== Start Asks =================================================================

    Route::get('ask', [AskController::class, 'index'])->name('ask.index');

    //======================== end Asks =================================================================

    //======================== Start Asks =================================================================

    Route::resource('account', AccountController::class);

    //======================== end Asks =================================================================
});

//======================== Start Login =================================================================
Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('get.admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
});

//======================== End Categories =================================================================

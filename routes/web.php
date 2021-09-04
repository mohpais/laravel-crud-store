<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderProductController;

/*
setCart
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login-access', [AuthController::class, 'doLogin'])->name('login-access');

Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');;
Route::post('register', [AuthController::class, 'register']);

Route::get('/', function (){
    return view('home');
})->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('order', OrderController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'is_admin'], function () {
    Route::resource('product', '\App\Http\Controllers\ProductController');
    Route::post('store-cart', [CartController::class, 'setCart'])->name('cart.store');
    Route::get('destroy-cart', [CartController::class, 'removeCart'])->name('cart.destroy');
    Route::delete('cart/{id}', [CartController::class, 'removeItem'])->name('cart.delete');
    Route::delete('order-product/{id}', [OrderProductController::class, 'destroy'])->name('orderproduct.delete');
});














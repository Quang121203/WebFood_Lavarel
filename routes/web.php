<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix("/admin")->middleware(['auth','test'])->group(function () {
    Route::get('/', function () {
        return view('layouts.admin');
    });

    Route::get('/category/getList', [CategoryController::class, 'getList'])->name('category.getList');
    Route::resource('/category', CategoryController::class);

    Route::get('/product/getList/{id}', [ProductController::class, 'getList'])->name('product.getList');
    Route::resource('/product', ProductController::class);

    Route::get('/order/getList/{status}', [OrderController::class, 'getList'])->name('order.getList');
    Route::resource('/order', OrderController::class);
});


Route::get('/', [HomeController::class, 'index']);
Route::get('/menu', [MenuController::class, 'index']);
Route::resource('/cart', CartController::class)->middleware('auth');;

Route::get('/order', [OrderController::class, 'indexHome'])->name('order.indexHome')->middleware('auth');;
Route::post('/order',[OrderController::class, 'store'])->name('order.store')->middleware('auth');;

Route::get('/product/category/{id}', [ProductController::class, 'getProductByCategory'])->name('product.category');
Route::resource('/product', ProductController::class);

Route::get('/check-out', function () {
    return view('pages.home.check-out');
});

Route::get('/register', function () {
    return view('pages.register');
});
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('pages.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
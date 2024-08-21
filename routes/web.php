<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/menu', [MenuController::class, 'index']);

Route::resource('/cart', CartController::class);
Route::resource('/order', OrderController::class);
Route::resource('/category', OrderController::class);

Route::get('/product/category/{id}', [ProductController::class, 'getProductByCategory'])->name('product.category');
Route::resource('/product', ProductController::class);

Route::get('/check-out',function(){
    return view('pages.check-out');
});


// ----------------------------------------------------------------
Route::get('/quick',function(){
    return view('pages.quick');
});
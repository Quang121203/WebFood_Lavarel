<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


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
Route::prefix("/admin")->middleware(['auth','author'])->group(function () {
    Route::get('/category/getList', [CategoryController::class, 'getList'])->name('category.getList');
    Route::resource('/category', CategoryController::class);

    Route::get('/product/getList/{id}', [ProductController::class, 'getList'])->name('product.getList');
    Route::resource('/product', ProductController::class);

    Route::get('/order/getList/{status}', [OrderController::class, 'getList'])->name('order.getList');
    Route::resource('/order', OrderController::class);

    Route::get('/role/getRoleUser/{id}', [RoleController::class, 'getRoleUser'])->name('role.getRoleUser');
    Route::get('/role/getList', [RoleController::class, 'getList'])->name('role.getList');
    Route::resource('/role', RoleController::class);

    Route::get('/user/getList/{id}/{isActive}', [UserController::class, 'getList'])->name('user.getList');
    Route::resource('/user', UserController::class);

    Route::get('/roleMenu/getList/{id}', [MenuController::class, 'getList'])->name('role.getListMenu');
    Route::post('/roleMenu', [MenuController::class, 'store'])->name('role.postListMenu');
});

Route::prefix("/admin")->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('layouts.admin');
    });
});


Route::get('/', [HomeController::class, 'index']);
Route::get('/info', function () {
    return Auth::user();
})->middleware('auth');
Route::get('/menu', [MenuController::class, 'index']);

Route::get('/cart/getCount', [CartController::class, 'getCount'])->name('cart.getCount');
Route::resource('/cart', CartController::class)->middleware('auth');
Route::get('/check-out', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');


Route::get('/order', [OrderController::class, 'indexHome'])->name('order.indexHome')->middleware('auth');
Route::post('/order',[OrderController::class, 'store'])->name('order.store')->middleware('auth');

Route::get('/product/category/{id}', [ProductController::class, 'getProductByCategory'])->name('product.category');
Route::resource('/product', ProductController::class);

Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile.getProfile')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'postProfile'])->name('profile.postProfile')->middleware('auth');

Route::post('changePassword', [UserController::class, 'changePassword'])->name('user.changePassword')->middleware('auth');

Route::get('/register', function () {
    return view('pages.register');
});
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('pages.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

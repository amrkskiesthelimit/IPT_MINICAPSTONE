<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LogController;

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

Route::get('/', [AuthController::class, 'loginForm' ])->name('login');
Route::get('/register', [AuthController::class, 'registerForm' ]);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');


     Route::get('/products', [ProductController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('products.index');
     Route::get('/products/create', [ProductController::class, 'create'])->middleware(['auth', 'role:admin'])->name('products.create');
     Route::post('/products', [ProductController::class, 'store'])->middleware(['auth', 'role:admin'])->name('products.store');
     Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
     Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('products.edit');
     Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
     Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('products.destroy');
     Route::get('/product-logs', [LogController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('product-logs');

     Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
     Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
     Route::match(['get', 'post'], '/products/{product}/buy', [ProductController::class, 'buy'])->name('products.buy');
     Route::post('/purchase/{product}', [ProductController::class, 'confirmPurchase'])->name('purchase.confirm');

     Route::post('/cart/buyAll/{category}', [CartController::class, 'buyAll'])->name('cart.buyAll');

     Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');





Route::get('verification/{user}/{token}', [AuthController::class, 'verification']);







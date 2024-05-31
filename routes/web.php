<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/category/{category:slug}', [HomeController::class, 'category'])->name('category');
Route::get('/product/{product:slug}', [HomeController::class, 'detail'])->name('detail');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
});

Route::prefix('dashboard')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('users', UserController::class);
    Route::post('/product/images', [ProductController::class, 'storeMedia'])->name('product.storeMedia');
    Route::get('/product/images/{product}', [ProductController::class, 'getEditMedia'])->name('product.edit.media');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

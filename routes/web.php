<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEnd\CartController;


Route::prefix('/')->group(function () {
    Route::resource('cart', CartController::class);
});

Route::get('/', function () {
    return view('home.index');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::post('/product/images', [ProductController::class, 'storeMedia'])->name('product.storeMedia');
    Route::get('/product/images/{product}', [ProductController::class, 'getEditMedia'])->name('product.edit.media');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

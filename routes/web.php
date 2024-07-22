<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleController;


Route::get('/', function () {
    return view('main');
})->name('main');


// Rutas para productos
Route::resource('products', ProductController::class);

// Rutas para carritos
Route::get('cart', [CartController::class, 'index'])->name('carts.index');
Route::post('cart/add/{productId}', [CartController::class, 'add'])->name('carts.add');
Route::delete('cart/remove/{itemId}', [CartController::class, 'remove'])->name('carts.remove');

// Rutas para ventas
Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
Route::post('sales/store', [SaleController::class, 'store'])->name('sales.store');


Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/appointments', function () {
    return view('appointments');
})->name('appointments');

Route::get('/login', function () {
    return view('login');
})->name('login');
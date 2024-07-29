<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

// Ruta para la exportación a Excel
Route::get('/products/export', function () {
    return Excel::download(new ProductsExport, 'productos.xlsx');
})->name('products.export');


// Ruta para la página principal
Route::get('/', [HomeController::class, 'index'])->name('main');

// Rutas para productos
Route::resource('products', ProductController::class);
Route::post('/products/{id}/offer', [ProductController::class, 'offer'])->name('products.offer');

// Rutas para carritos
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('carts.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('carts.add');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('carts.remove'); 
});

// Rutas para ventas
Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
Route::post('sales/store', [SaleController::class, 'store'])->name('sales.store');

// Rutas para otras páginas
Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/appointments', function () {
    return view('appointments');
})->name('appointments');

// Rutas para autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('logout', function () { Auth::logout(); return redirect('/');})->name('logout');

// Obtener las ofertas
Route::get('/offers', [ProductController::class, 'showOffers'])->name('offers.index');

//citas medicas
Route::get('/citas_medicas', function () {
    return view('citas_medicas');
})->name('citas_medicas.index');

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
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SalesController;

// Ruta para la exportación a Excel
Route::get('/products/export', function () {
    return Excel::download(new ProductsExport, 'productos.xlsx');
})->name('products.export');


// Ruta para la página principal
Route::get('/', [HomeController::class, 'index'])->name('main');

// Rutas para productos
Route::resource('products', ProductController::class);
Route::post('/products/{id}/offer', [ProductController::class, 'offer'])->name('products.offer');
Route::get('/offers', [ProductController::class, 'offers'])->name('offers.index');

// Rutas para carritos
Route::get('cart', [CartController::class, 'index'])->name('carts.index');
Route::post('cart/add/{productId}', [CartController::class, 'add'])->name('carts.add');
Route::delete('cart/remove/{itemId}', [CartController::class, 'remove'])->name('carts.remove');

// Rutas para ventas
Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
Route::post('sales/store', [SaleController::class, 'store'])->name('sales.store');

// Rutas para autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('logout', function () { Auth::logout(); return redirect('/');})->name('logout');

// Obtener las ofertas
Route::get('/offers', [ProductController::class, 'showOffers'])->name('offers.index');

//citas medicas
Route::middleware(['auth'])->group(function () {
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::patch('/appointments/{appointment}', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});


// Ruta para mostrar las ventas
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');

// Ruta para almacenar una nueva venta
Route::post('/sale', [SaleController::class, 'ajaxStore'])->name('sales.ajaxStore');





use App\Http\Controllers\Admin\InventarioController;
use App\Http\Controllers\Admin\FacturasController;
use App\Http\Controllers\Admin\CitasController;
use App\Http\Controllers\Admin\RegistroUsuarioController;

// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.index');
//     })->name('admin.index');

//     Route::get('/inventario', [InventarioController::class, 'index'])->name('admin.inventario');
//     Route::get('/facturas', [FacturasController::class, 'index'])->name('admin.facturas');
//     Route::get('/citas', [CitasController::class, 'index'])->name('admin.citas');
//     Route::get('/registro-usuario', [RegistroUsuarioController::class, 'index'])->name('admin.registro_usuario');
// });

    // Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::get('/inventario', [InventarioController::class, 'index'])->name('admin.inventario');
//     Route::get('/facturas', [FacturasController::class, 'index'])->name('admin.facturas');
//     Route::get('/citas', [CitasController::class, 'index'])->name('admin.citas');
//     Route::get('/registro-usuario', [RegistroUsuarioController::class, 'index'])->name('admin.registro_usuario');
// });

Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/inventario', [InventarioController::class, 'index'])->name('admin.inventario');
    Route::get('/facturas', [FacturasController::class, 'index'])->name('admin.facturas');
    Route::get('/citas', [citasController::class, 'index'])->name('admin.citas');
    Route::get('/registro-usuario', [RegistroUsuarioController::class, 'index'])->name('admin.registro_usuario');
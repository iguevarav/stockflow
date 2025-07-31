<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MovimientoInventarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\ProveedorController;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('productos', ProductoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('movimientos', MovimientoInventarioController::class);

    Route::group(['prefix' => 'clientes'], function () {
        Route::get('/index', [ClienteController::class, 'index'])->name('clientes.index');
        Route::get('/create', [ClienteController::class, 'create'])->name('clientes.create');
        Route::post('/store', [ClienteController::class, 'store'])->name('clientes.store');
        Route::get('/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
        Route::put('/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');
        Route::delete('/destroy/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
        Route::get('/show/{id}', [ClienteController::class, 'show'])->name('clientes.show');
        Route::get('/buscar', [CLienteController::class, 'buscar'])->name('clientes.buscar');
    });

    Route::group(['prefix' => 'proveedores'], function () {
        Route::get('/index', [ProveedorController::class, 'index'])->name('proveedores.index');
        Route::get('/create', [ProveedorController::class, 'create'])->name('proveedores.create');
        Route::post('/store', [ProveedorController::class, 'store'])->name('proveedores.store');
        Route::get('/edit/{id}', [ProveedorController::class, 'edit'])->name('proveedores.edit');
        Route::put('/update/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
        Route::delete('/destroy/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
        Route::get('/show/{id}', [ProveedorController::class, 'show'])->name('proveedores.show');
        Route::get('/buscar', [ProveedorController::class, 'buscar'])->name('proveedores.buscar');
    });


    Route::group(['prefix' => 'orden_compra'], function () {
        Route::get('/index', [OrdenCompraController::class, 'index'])->name('orden_compra.index');
        Route::get('/create', [OrdenCompraController::class, 'create'])->name('orden_compra.create');
        Route::post('/store', [OrdenCompraController::class, 'store'])->name('orden_compra.store');
        Route::get('/show/{id}', [OrdenCompraController::class, 'show'])->name('orden_compra.show');
        Route::get('/edit/{id}', [OrdenCompraController::class, 'edit'])->name('orden_compra.edit');
        Route::put('/update/{id}', [OrdenCompraController::class, 'update'])->name('orden_compra.update');
        Route::delete('/destroy/{id}', [OrdenCompraController::class, 'destroy'])->name('orden_compra.destroy');
        Route::get('/buscar', [OrdenCompraController::class, 'buscar'])->name('orden_compra.buscar');
        Route::post('/set_estado/{id}', [OrdenCompraController::class, 'setEstado'])->name('orden_compra.set_estado');
    });

    // Rutas del módulo de ventas
    Route::prefix('ventas')->name('ventas.')->group(function () {
        Route::get('/', [App\Http\Controllers\VentaController::class, 'index'])->name('index');
        Route::get('/crear', [App\Http\Controllers\VentaController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\VentaController::class, 'store'])->name('store');
        Route::get('/{venta}', [App\Http\Controllers\VentaController::class, 'show'])->name('show');
        Route::get('/{venta}/editar', [App\Http\Controllers\VentaController::class, 'edit'])->name('edit');
        Route::put('/{venta}', [App\Http\Controllers\VentaController::class, 'update'])->name('update');
        Route::delete('/{venta}', [App\Http\Controllers\VentaController::class, 'destroy'])->name('destroy');
        Route::get('/buscar', [App\Http\Controllers\VentaController::class, 'buscar'])->name('buscar');
    });

    
});

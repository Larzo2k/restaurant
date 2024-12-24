<?php

use App\Http\Controllers\Admin\AlmacenController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ProveedorController;
use Illuminate\Support\Facades\Route;
use PSpell\Config;

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

Route::get('/', function () {
    return view('admin.auth.login');
});
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('auth', [AuthController::class, 'auth'])->name('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');;

Route::group(['prefix'=>'admin','middleware' => ['auth']], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('configuration', [ConfiguracionController::class, 'index'])->name('configuration');
    Route::post('configuration/update', [ConfiguracionController::class, 'update'])->name('configuration.update');
    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::group(['prefix'=>'cliente'], function(){
        Route::post('store', [ClienteController::class, 'store'])->name('clientes.store');
        Route::post('update/{id}', [ClienteController::class, 'update'])->name('clientes.update');
        Route::post('delete/{id}', [ClienteController::class, 'delete'])->name('clientes.delete');
    });
    Route::get('proveedor', [ProveedorController::class, 'index'])->name('proveedor');
    Route::group(['prefix'=>'proveedor'], function(){
        Route::post('store', [ProveedorController::class, 'store'])->name('proveedor.store');
        Route::post('update/{id}', [ProveedorController::class, 'update'])->name('proveedor.update');
        Route::post('delete/{id}', [ProveedorController::class, 'delete'])->name('proveedor.delete');
    });
    Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias');
    Route::group(['prefix'=>'categoria'], function(){
        Route::post('store', [CategoriaController::class, 'store'])->name('categoria.store');
        Route::post('update/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
        Route::post('delete/{id}', [CategoriaController::class, 'delete'])->name('categoria.delete');
    });
    Route::get('almacen', [AlmacenController::class, 'index'])->name('almacen');
    Route::group(['prefix'=>'almacen'], function(){
        Route::post('store', [AlmacenController::class, 'store'])->name('almacen.store');
        Route::post('update/{id}', [AlmacenController::class, 'update'])->name('almacen.update');
        Route::post('delete/{id}', [AlmacenController::class, 'delete'])->name('almacen.delete');
    });
    Route::get('producto', [ProductoController::class, 'index'])->name('productos');
    Route::group(['prefix'=>'producto'], function(){
        Route::post('store', [ProductoController::class, 'store'])->name('producto.store');
        Route::post('update/{id}', [ProductoController::class, 'update'])->name('producto.update');
        Route::post('delete/{id}', [ProductoController::class, 'delete'])->name('producto.delete');
        Route::get('barcode', [ProductoController::class, 'getCodigo'])->name('producto.getCodigo');
        Route::get('verify-code', [ProductoController::class, 'verifyCode'])->name('producto.verifyCode');
    });

});
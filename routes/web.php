<?php

use App\Http\Controllers\Admin\AlmacenController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PedidoController as AdminPedidoController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Cliente\AuthController as ClienteAuthController;
use App\Http\Controllers\Cliente\CarritoController;
use App\Http\Controllers\Cliente\PedidoController;
use App\Http\Controllers\Cliente\ProductController;
use App\Http\Controllers\Cliente\QrController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DailyMenuController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::check()){
        return redirect()->route('index');
    } else{
        return view('admin.auth.login');
    }
});
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('auth', [AuthController::class, 'auth'])->name('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');;

Route::group(['prefix'=>'admin','middleware' => ['auth']], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('chart', [DashboardController::class, 'chart'])->name('chart');
    Route::get('configuration', [ConfiguracionController::class, 'index'])->name('configuration');
    Route::post('configuration/update', [ConfiguracionController::class, 'update'])->name('configuration.update');
    
    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::group(['prefix'=>'cliente'], function(){
        Route::post('store', [ClienteController::class, 'store'])->name('clientes.store');
        Route::post('update/{id}', [ClienteController::class, 'update'])->name('clientes.update');
        Route::post('delete/{id}', [ClienteController::class, 'delete'])->name('clientes.delete');
    });
    
    Route::get('daily_menus', [DailyMenuController::class, 'index'])->name('daily_menus');
    Route::group(['prefix'=>'daily-menu'], function(){
        Route::post('/store', [DailyMenuController::class, 'store'])->name('daily_menu.store');
        Route::post('/update/{id}', [DailyMenuController::class, 'update'])->name('daily_menu.update');
        Route::post('/delete/{id}', [DailyMenuController::class, 'delete'])->name('daily_menu.delete');
    });
    
    Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias');
    Route::group(['prefix'=>'categoria'], function(){
        Route::post('store', [CategoriaController::class, 'store'])->name('categoria.store');
        Route::post('update/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
        Route::post('delete/{id}', [CategoriaController::class, 'delete'])->name('categoria.delete');
    });
    Route::get('producto', [ProductoController::class, 'index'])->name('productos');
    Route::group(['prefix'=>'producto'], function(){
        Route::post('store', [ProductoController::class, 'store'])->name('producto.store');
        Route::post('update/{id}', [ProductoController::class, 'update'])->name('producto.update');
        Route::post('delete/{id}', [ProductoController::class, 'delete'])->name('producto.delete');
        Route::get('barcode', [ProductoController::class, 'getCodigo'])->name('producto.getCodigo');
        Route::get('verify-code', [ProductoController::class, 'verifyCode'])->name('producto.verifyCode');
    });
    
    
    Route::get('venta',[VentaController::class, 'index'])->name('ventas');
    Route::group(['prefix'=>'venta'], function(){
        Route::post('store', [VentaController::class, 'store'])->name('venta.store');
        Route::post('update/{id}', [VentaController::class, 'update'])->name('venta.update');
        Route::post('delete/{id}', [VentaController::class, 'delete'])->name('venta.delete');
        Route::get('pdf/{id}', [VentaController::class, 'getPdf'])->name('venta.pdf');
        Route::get('history', [VentaController::class, 'history'])->name('venta.history');
    });
    Route::get('pedido', [AdminPedidoController::class, 'index'])->name('admin.pedido.index');

    Route::get('prueba', [VentaController::class, 'prueba'])->name('prueba');
    Route::get('prueba2', [VentaController::class, 'prueba2'])->name('prueba2');
});

Route::get('login-cliente', [ClienteAuthController::class, 'showLogin'])->name('login');
Route::post('auth-cliente', [ClienteAuthController::class, 'login'])->name('cliente.login.post');
Route::get('logout-cliente', [ClienteAuthController::class, 'logout'])->name('cliente.logout');;
Route::group(['prefix'=>'cliente', 'middleware' => ['auth:cliente']], function(){
    Route::get('products', [ProductController::class, 'index'])->name('cliente.products.index');
    Route::get('carrito', [CarritoController::class, 'index'])->name('cliente.products.carrito');
    Route::post('carrito/store', [CarritoController::class, 'store'])->name('cliente.products.store');
    Route::get('pedido', [PedidoController::class, 'index'])->name('cliente.pedido.index');
    Route::get('pedido/pdf/{id}', [PedidoController::class, 'getPdf'])->name('cliente.pedido.pdf');
    Route::post('generate-qr', [QrController::class, 'generateQr'])->name('generateQr');
    Route::post('/pedido/verify-payment', [QrController::class, 'verifyPayment'])->name('cliente.qr.verifyPayment');
    // Route::get('add-to-carrito/{id}', [ProductController::class, 'addToCarrito'])->name('cliente.products.addToCarrito');
    // Route::get('delete-from-carrito/{id}', [ProductController::class, 'deleteFromCarrito'])->name('cliente.products.deleteFromCarrito');
    // Route::get('comprar', [CompraController::class, 'index'])->name('cliente.comprar.index');
});
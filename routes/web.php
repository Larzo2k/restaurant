<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\DashboardController;
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
});
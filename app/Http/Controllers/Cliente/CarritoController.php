<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index(){
        return view('cliente.carrito.index');
    }
}

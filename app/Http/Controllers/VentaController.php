<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Utils\DeloWass;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $productos = Producto::where('status', 1)->get();
        $clientes = Cliente::where('status', 1)->get();
        return view('admin.venta.create', compact('productos', 'clientes'));
    }
    public function prueba(){
        $message = "hola, esta es una prueb para enviar mensajes";
        DeloWass::enviarTexto('+59170906491', $message);
    }
}
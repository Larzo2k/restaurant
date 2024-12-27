<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $productos = Producto::where('status', 1)->get();
        $proveedores = Proveedor::where('status', 1)->get();
        return view('admin.compra.create', compact('productos', 'proveedores'));
    }
}
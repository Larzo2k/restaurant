<?php

namespace App\Http\Controllers;

use App\Jobs\SenNotificationProveedor;
use App\Models\Compra;
use App\Models\DetalleCompra;
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
    public function store(Request $request)
    {
        try{
            $user_id = auth()->user()->id;
            $compra = Compra::storeCompra($user_id,$request->id_proveedor, $request->fecha,$request->total);
            $productos=$request->productos;
            foreach ($productos as $producto) {
                DetalleCompra::storeDetalleCompra($compra->id->toString(), $producto['nombre'], $producto['cantidad'],$producto['subtotal'], $producto['precio'], $producto['precio_venta']);
            }
            //enviar notificacion al proveedor
            SenNotificationProveedor::dispatch($request->id_proveedor, $compra->id);
            return response()->json([
                'codigo' => 0,
                'data' => $compra,
                'mensaje' => 'Compra creada con exitosamente.'
            ]);
        }catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
}
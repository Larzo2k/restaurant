<?php

namespace App\Http\Controllers;

use App\Jobs\SenNotificationClient;
use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use App\Utils\DeloWass;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $productos = Producto::where('stock', '>', 0)->with('category')->with('detallesCompra')->where('status', 1)->get();
        $clientes = Cliente::where('status', 1)->get();
        return view('admin.venta.create', compact('productos', 'clientes'));
    }
    public function store(Request $request)
    {
        try{
            if(self::verifyStockProducto($request->productos)){
                return response()->json(["codigo" => 1, 'mensaje' => 'No hay stock suficiente', "data" => null]);
            }
            $user_id = auth()->user()->id;
            $venta = Venta::storeVenta($user_id,$request->id_cliente, $request->fecha,$request->total);
            $productos=$request->productos;
            foreach ($productos as $producto) {
                DetalleVenta::storeDetalleVenta($venta->id->toString(), $producto['nombre'], $producto['cantidad'],$producto['subtotal']);
            }
            //enviar notificacion al proveedor
            SenNotificationClient::dispatch($request->id_cliente, $venta->id);
            return response()->json([
                'codigo' => 0,
                'data' => $venta,
                'mensaje' => 'Venta creada con exitosamente.'
            ]);
        }catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function prueba(){
        $message = "hola, esta es una prueb para enviar mensajes";
        DeloWass::enviarTexto('+59170906491', $message);
    }
    public function verifyStockProducto($productos){
        foreach ($productos as $producto) {
            $producto = Producto::where('name', $producto['nombre'])->first();
            if($producto['cantidad'] > $producto->stock){
                return true;
            }
        }
        return false;
    }
}
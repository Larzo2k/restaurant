<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Jobs\GeneratePdfPedidoDownloadJob;
use App\Jobs\SendNotificationClientePedidoAndAdminJob;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    public function index(){
        return view('cliente.carrito.index');
    }
    public function store(Request $request){
        DB::beginTransaction();
        try{
            if (self::verifyStockProducto($request->carrito)) {
                return response()->json(["codigo" => 1, 'mensaje' => 'No hay stock suficiente', "data" => null]);
            }
            $total = self::getTotalCarrito($request->carrito);
            $date = date('Y-m-d');
            $user_id = auth()->user()->id;
            $pedido = Pedido::storePedido($user_id, $date, $total);
            foreach ($request->carrito as $producto) {
                DetallePedido::storeDetallePedido($pedido->id->toString(), $producto['name'], $producto['price'], $producto['cantidad']);
            }
            GeneratePdfPedidoDownloadJob::dispatch($pedido->id);
            //enviar notificacion al proveedor
            // SendNotificationClientePedidoAndAdminJob::dispatch($user_id, $pedido->id);
            DB::commit();
            return response()->json([
                'codigo' => 0,
                'mensaje' => 'Producto agregado al carrito',
                'data' => $pedido
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function verifyStockProducto($productos)
    {
        foreach ($productos as $producto) {
            $producto = Producto::with('dailyMenuProduct')->where('name', $producto['name'])->first();
            if ($producto['cantidad'] > $producto->dailyMenuProduct->stock) {
                return true;
            }
        }
        return false;
    }
    public function getTotalCarrito($productos)
    {
        $total = 0;
        foreach ($productos as $producto) {
            $total += $producto['price'] * $producto['cantidad'];
        }
        return $total;
    }
}

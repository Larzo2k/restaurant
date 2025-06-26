<?php

namespace App\Http\Controllers;

use App\Jobs\GeneratePdfVentaDownloadJob;
use App\Jobs\SendNotificationPruebaJob;
use App\Jobs\SenNotificationClient;
use App\Models\Cliente;
use App\Models\DailyMenu;
use App\Models\DailyMenuProduct;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use App\Utils\DeloWass;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Barryvdh\DomPDF\Facade\Pdf;

class VentaController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d');

        $daily_menu = DailyMenu::where('date', $date)
            ->where('status', 1)
            ->first();

        // Si hay menú, obtenemos los productos asociados, si no, una colección vacía
        $dayly_menu_products = $daily_menu
            ? DailyMenuProduct::where('daily_menu_id', $daily_menu->id)->where('status', 1)->get()
            : collect();
        // Obtenemos los IDs de los productos en el menú
        $productosEnMenuIDs = $dayly_menu_products->pluck('product_id')->toArray();

        // Productos que están en el menú
        $productos = Producto::with(['dailyMenuProduct','category'])->whereIn('id', $productosEnMenuIDs)
                            ->where('status', 1)
                            ->get();
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
            GeneratePdfVentaDownloadJob::dispatch($venta->id);
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
        SendNotificationPruebaJob::dispatch();
        // $message = "hola, esta es una prueb para enviar mensajes sin jobs";
        // DeloWass::enviarTexto('+59163448258', $message);
    }
    public function prueba2(){
        try{
            $message = "hola, esta es una prueb para enviar mensajes sin jobs";
            $response = DeloWass::enviarTexto('+59163448258', $message);
            dd($response);
        }catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function verifyStockProducto($productos){
        foreach ($productos as $producto) {
            $producto = Producto::with('dailyMenuProduct')->where('name', $producto['nombre'])->first();
            if($producto['cantidad'] > $producto->dailyMenuProduct->stock){
                return true;
            }
        }
        return false;
    }
    public function getPdf($venta_id){
        try {
            $venta = Venta::findOrfail($venta_id);
            $data = [
                'venta' => $venta,
            ];
            $pdf = PDF::loadView('admin.venta.pdf', $data);
            return $pdf->stream('detalle_recibo.pdf');
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function history(){
        $ventas = Venta::where('user_id', auth()->user()->id)->paginate(10);
        return view('admin.venta.history', compact('ventas'));
    }
}
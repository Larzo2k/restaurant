<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $diaActual = date('Y-m-d');
        // $productosConStockCero = DB::table('product')
        //                     ->where('stock', 0)
        //                     ->count();
        // $productosConStockCero = 0;
        $productosConStockCero = DB::table('daily_menu_product')
                        ->where('stock', 0)
                        ->whereDate('created_at', now()->toDateString())
                        ->count();
        $ventaTotal = Venta::whereDate('created_at', $diaActual)->sum('total');
        $totalProductos = DB::table('product')->count();
        return view('admin.dashboard.index', compact('productosConStockCero', 'ventaTotal', 'totalProductos'));
    }
    public function chart()
    {
        $response = [
            'chart' => self::productosMasVendidos(),
        ];
        return response()->json($response);
    }
    // public function productosMasVendidos()
    // {
    //     $productosMasVendidos = DetalleVenta::select('product_id', DB::raw('SUM(cantidad) as total_vendido'))
    //         ->groupBy('product_id')
    //         ->orderByDesc('total_vendido')
    //         ->limit(5)
    //         ->get();

    //     // Obtener los IDs de los productos para cargar los nombres
    //     $productoIds = $productosMasVendidos->pluck('product_id')->toArray();

    //     // Obtener los nombres de los productos
    //     $productos = Producto::whereIn('id', $productoIds)->pluck('name', 'id');

    //     // Estructurar los datos para el gráfico
    //     $datosGraficos = [];
    //     foreach ($productosMasVendidos as $producto) {
    //         $nombreProducto = $productos[$producto->product_id];
    //         $datosGraficos[] = [
    //             'nombre' => $nombreProducto,
    //             'total_vendido' => $producto->total_vendido,
    //         ];
    //     }

    //     return $datosGraficos;
    // }

    public function productosMasVendidos()
    {
        // Paso 1: Obtener todos los detalles de ventas de hoy con sus productos
        $detalles = DetalleVenta::with('dailyMenuProduct.product')
            ->whereDate('created_at', Carbon::today())
            ->whereHas('dailyMenuProduct', function ($query) {
                $query->where('status', 1);
            })
            ->get();
        // Paso 2: Agrupar por producto_id
        $conteo = [];
        foreach ($detalles as $detalle) {
            $producto = $detalle->DailyMenuProduct->product ?? null;
            if ($producto) {
                $productoId = $producto->id;
                $nombre = $producto->name;

                if (!isset($conteo[$productoId])) {
                    $conteo[$productoId] = [
                        'nombre' => $nombre,
                        'total_vendido' => 0
                    ];
                }
                $conteo[$productoId]['total_vendido'] += $detalle->cantidad;
            }
        }

        // Paso 3: Tomar los 5 productos más vendidos
        $topProductos = collect($conteo)
            ->sortByDesc('total_vendido')
            ->take(5)
            ->values()
            ->toArray();

        return $topProductos;
    }


}
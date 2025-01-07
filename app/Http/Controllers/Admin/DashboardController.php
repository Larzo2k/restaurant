<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $diaActual = date('Y-m-d');
        $productosConStockCero = DB::table('product')
                            ->where('stock', 0)
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
    public function productosMasVendidos()
    {
        $productosMasVendidos = DetalleVenta::select('product_id', DB::raw('SUM(cantidad) as total_vendido'))
            ->groupBy('product_id')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();

        // Obtener los IDs de los productos para cargar los nombres
        $productoIds = $productosMasVendidos->pluck('product_id')->toArray();

        // Obtener los nombres de los productos
        $productos = Producto::whereIn('id', $productoIds)->pluck('name', 'id');

        // Estructurar los datos para el gráfico
        $datosGraficos = [];
        foreach ($productosMasVendidos as $producto) {
            $nombreProducto = $productos[$producto->product_id];
            $datosGraficos[] = [
                'nombre' => $nombreProducto,
                'total_vendido' => $producto->total_vendido,
            ];
        }

        return $datosGraficos;
    }
}
<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\DailyMenu;
use App\Models\DailyMenuProduct;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Producto::with(['dailyMenuProduct', 'category'])->whereIn('id', $productosEnMenuIDs)
            ->where('status', 1)
            ->get();
        return view('cliente.products.index', compact('products'));
    }
}

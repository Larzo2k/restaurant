<?php

namespace App\Http\Controllers;

use App\Models\DailyMenu;
use App\Models\DailyMenuProduct;
use App\Models\Producto;
use Illuminate\Http\Request;

class DailyMenuController extends Controller
{
    public function index(){
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
        $productoEnMenu = Producto::with(['dailyMenuProduct','category'])->whereIn('id', $productosEnMenuIDs)
                            ->where('status', 1)
                            ->get();
        // Productos que NO están en el menú
        $productosNoEnMenu = Producto::whereNotIn('id', $productosEnMenuIDs)
                            ->where('status', 1)
                            ->get();
        
        return view('admin.daily-menu.index', compact('productoEnMenu', 'productosNoEnMenu'));
    }
    public function store(Request $request){
        try{
            $daily_menu  = self::createOrReturnMenuDaily();
            foreach ($request->productos as $index => $productId) {
                $stock = $request->stock[$index] ?? 0; // Si no hay stock, pon 0

                DailyMenuProduct::create([
                    'id' => uuid_create(),
                    'daily_menu_id' => $daily_menu->id,
                    'product_id' => $productId,
                    'stock' => $stock,
                    'quantity' => $stock,
                ]);
            }
            return response()->json([
                'codigo' => 0,
                'mensaje' => 'Menu creado con exito',
                'data' => DailyMenu::listarView(),
            ]);
        }catch(\Throwable $th){
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function update($id, Request $request){
        try{   
            DailyMenuProduct::updateDailyMenuProduct($id, $request->stock);
            return response()->json([
                'codigo' => 0,  
                'mensaje' => 'Producto del menu actualizado con exito',  
                'data' => DailyMenu::listarView(),
            ]);
        }catch(\Throwable $th){
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function delete($id){
        try{
            DailyMenuProduct::deleteDailyMenuProduct($id);
            return response()->json([
                'codigo' => 0,  
                'mensaje' => 'Producto del menu eliminado con exito',  
                'data' => DailyMenu::listarView(),
            ]);
        }catch(\Throwable $th){
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function createOrReturnMenuDaily(){
        $date = date('Y-m-d');
        $daily_menu = DailyMenu::where('date', $date)
            ->where('status', 1)
            ->first();
        if(!$daily_menu){
            $daily_menu = DailyMenu::create([
                'id' => uuid_create(),
                'date' => $date,
                'status' => 1
            ]);
        }
        return $daily_menu;
    }
}
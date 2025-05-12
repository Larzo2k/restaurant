<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Termwind\render;

class DailyMenu extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'daily_menus';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'date',
        'status',
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public static function listarView(){
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
                            
        $view = view('admin.daily-menu.table', compact('productoEnMenu', 'productosNoEnMenu'))->render();
        return $view;
    }
}
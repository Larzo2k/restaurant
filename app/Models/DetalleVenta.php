<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'detalle_venta';
    public $timestamps = true;
    protected $fillable = [
        'id', 
        'cantidad',	
        'subtotal',	
        'venta_id',
        'product_id',	
        'status',
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public function DailyMenuProduct()
    {
        // return $this->belongsTo(DailyMenuProduct::class, 'id_producto_menu');
        return $this->belongsTo(DailyMenuProduct::class, 'daily_menu_product_id');
    }
    public static function storeDetalleVenta($venta_id, $product, $cantidad, $subtotal){
        $product = Producto::with('dailyMenuProduct')->where('name', $product)->first();
        $detalle_venta = new DetalleVenta();
        $detalle_venta->id = Str::uuid();
        $detalle_venta->venta_id = $venta_id;
        $detalle_venta->daily_menu_product_id = $product->dailyMenuProduct->id;
        $detalle_venta->cantidad = $cantidad;
        $detalle_venta->subtotal = $subtotal;
        $detalle_venta->status = self::ESTADO_ACTIVO;
        $detalle_venta->save();
        self::DecrementarStockProduct($product->dailyMenuProduct->id, $cantidad);
        return $detalle_venta;
    }
    public static function DecrementarStockProduct($product_daily_menu_id, $cantidad){
        $daily_menu_product = DailyMenuProduct::find($product_daily_menu_id);
        $daily_menu_product->stock = $daily_menu_product->stock - $cantidad;
        $daily_menu_product->update();
    }
}
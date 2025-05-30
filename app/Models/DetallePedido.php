<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DetallePedido extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
    protected $table = 'detalle_pedido';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'cantidad',
        'subtotal',
        'venta_id',
        'daily_menu_product_id',
        'status',
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public static function storeDetallePedido($pedido_id, $product, $price, $cantidad){
        $product = Producto::with('dailyMenuProduct')->where('name', $product)->first();
        $detalle_pedido = new DetallePedido();
        $detalle_pedido->id = Str::uuid();
        $detalle_pedido->pedido_id = $pedido_id;
        $detalle_pedido->daily_menu_product_id = $product->dailyMenuProduct->id;
        $detalle_pedido->cantidad = $cantidad;
        $detalle_pedido->subtotal = floatval($price*$cantidad);
        $detalle_pedido->status = self::ESTADO_ACTIVO;
        $detalle_pedido->save();
        self::DecrementarStockProduct($product->dailyMenuProduct->id, $cantidad);
        return $detalle_pedido;
    }
    public static function DecrementarStockProduct($product_daily_menu_id, $cantidad)
    {
        $daily_menu_product = DailyMenuProduct::find($product_daily_menu_id);
        $daily_menu_product->stock = $daily_menu_product->stock - $cantidad;
        $daily_menu_product->update();
    }
    public function DailyMenuProduct()
    {
        // return $this->belongsTo(DailyMenuProduct::class, 'id_producto_menu');
        return $this->belongsTo(DailyMenuProduct::class, 'daily_menu_product_id');
    }
}

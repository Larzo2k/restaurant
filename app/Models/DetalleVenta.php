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
    public static function storeDetalleVenta($venta_id, $product, $cantidad, $subtotal){
        $product_id = Producto::where('name', $product)->first()->id;
        $detalle_venta = new DetalleVenta();
        $detalle_venta->id = Str::uuid();
        $detalle_venta->venta_id = $venta_id;
        $detalle_venta->product_id = $product_id;
        $detalle_venta->cantidad = $cantidad;
        $detalle_venta->subtotal = $subtotal;
        $detalle_venta->status = self::ESTADO_ACTIVO;
        $detalle_venta->save();
        self::DecrementarStockProduct($product_id, $cantidad);
        return $detalle_venta;
    }
    public static function DecrementarStockProduct($product_id, $cantidad){
        $product = Producto::find($product_id);
        $product->stock = $product->stock - $cantidad;
        $product->update();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'detalle_compra';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'compra_id',	
        'product_id',	
        'cantidad',	
        'subtotal',	
        'precio_compra',	
        'precio_venta'
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    
    public static function storeDetalleCompra($compra_id, $product, $cantidad, $subtotal, $precio_compra, $precio_venta){
        $product_id = Producto::where('name', $product)->first()->id;
        $detalle_compra = new DetalleCompra();
        $detalle_compra->id = Str::uuid();
        $detalle_compra->compra_id = $compra_id;
        $detalle_compra->product_id = $product_id;
        $detalle_compra->cantidad = $cantidad;
        $detalle_compra->subtotal = $subtotal;
        $detalle_compra->precio_compra = $precio_compra;
        $detalle_compra->precio_venta = $precio_venta;
        $detalle_compra->status = self::ESTADO_ACTIVO;
        $detalle_compra->save();
        self::IncrementarStockProduct($product_id, $cantidad);
    }
    public static function IncrementarStockProduct($product_id, $cantidad){
        $product = Producto::find($product_id);
        $product->stock = $product->stock + $cantidad;
        $product->update();
    }
}
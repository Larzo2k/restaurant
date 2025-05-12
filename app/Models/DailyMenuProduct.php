<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMenuProduct extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'daily_menu_product';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'quantity',
        'daily_menu_id',
        'stock',
        'product_id',
        'status',
    ];
    public static function updateDailyMenuProduct($id, $stock){
        $daily_menu_product = DailyMenuProduct::find($id);
        if($daily_menu_product->stock != $daily_menu_product->quantity){
            $diference = $daily_menu_product->stock - $daily_menu_product->quantity;
            $daily_menu_product->stock = $stock - $diference;
            $daily_menu_product->quantity = $stock - $diference;
        }else{
            $daily_menu_product->stock = $stock;
            $daily_menu_product->quantity = $stock;
        }
        $daily_menu_product->save();
    }
    public static function deleteDailyMenuProduct($id){
        $daily_menu_product = DailyMenuProduct::find($id);  
        $daily_menu_product->status = self::ESTADO_INACTIVO;
        $daily_menu_product->update();
        // $daily_menu_product->delete();
    }
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public function product(){
        return $this->belongsTo(Producto::class, 'product_id', 'id');
    }
}
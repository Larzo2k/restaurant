<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Venta extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'venta';
    public $timestamps = true;
    protected $fillable = [
        'id', 
        'fecha',	
        'total',	
        'customer_id',	
        'user_id',	
        'status',
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public static function storeVenta($user_id, $customer_id, $fecha, $total){
        $venta = new Venta();
        $venta->id = Str::uuid();
        $venta->user_id = $user_id;
        $venta->customer_id = $customer_id;
        $venta->fecha = $fecha;
        $venta->total = $total;
        $venta->status = self::ESTADO_ACTIVO;
        $venta->save();
        return $venta;
    }
}
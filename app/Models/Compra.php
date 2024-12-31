<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Compra extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'compra';
    public $timestamps = true;
    protected $fillable = [
        'id', 
        'fecha',	
        'total',	
        'supplier_id',	
        'user_id',	
        'status',
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    
    public static function storeCompra($user_id, $supplier_id, $fecha, $total){
        $compra = new Compra();
        $compra->id = Str::uuid();
        $compra->user_id = $user_id;
        $compra->supplier_id = $supplier_id;
        $compra->fecha = $fecha;
        $compra->total = $total;
        $compra->status = self::ESTADO_ACTIVO;
        $compra->save();
        return $compra;
    }
}
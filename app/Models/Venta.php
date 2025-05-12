<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

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
        'nro_recibo',
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public static function storeVenta($user_id, $customer_id, $fecha, $total){
        $venta = new Venta();
        $venta->id = Str::uuid();
        $venta->nro_recibo  = self::getUltimoRecibo() + 1;
        $venta->user_id = $user_id;
        $venta->customer_id = $customer_id;
        $venta->fecha = $fecha;
        $venta->total = $total;
        $venta->status = self::ESTADO_ACTIVO;
        $venta->save();
        return $venta;
    }
    public static function getUltimoRecibo(){
        $venta = Venta::orderBy('nro_recibo', 'desc')->first();
        if($venta == null){
            return 1;
        }
        return $venta->nro_recibo;
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function customer(){
        return $this->belongsTo(Cliente::class, 'customer_id', 'id');
    }
    public function detalleVenta(){
        return $this->hasMany(DetalleVenta::class, 'venta_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pedido extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
    protected $table = 'pedido';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'fecha',
        'total',
        'customer_id',
        'status',
        'nro_recibo',
        'is_pago',
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public static function storePedido($user_id, $fecha, $total){
        $pedido = new Pedido();
        $pedido->id = Str::uuid();
        $pedido->nro_recibo  = self::getUltimoReciboPlusOne();
        $pedido->customer_id = $user_id;
        $pedido->fecha = $fecha;
        $pedido->total = $total;
        $pedido->status = self::ESTADO_ACTIVO;
        $pedido->save();
        return $pedido;
    }
    public static function getUltimoReciboPlusOne()
    {
        $venta = Pedido::orderBy('nro_recibo', 'desc')->first();
        if ($venta == null) {
            return 1;
        }
        return $venta->nro_recibo + 1;
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
    public function customer()
    {
        return $this->belongsTo(Cliente::class, 'customer_id', 'id');
    }
    public function detallePedido()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id', 'id');
    }
    public static function getAllPedidosUser($user_id){
        $pedidos = Pedido::where('customer_id', $user_id)->get();
        return $pedidos;
    }
}

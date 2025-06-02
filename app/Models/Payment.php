<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
    protected $table = 'payment';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'pedido_id',
        'path_qr',
        'data',
        'movement_id',
        'is_pago',
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    const PAGO_VERIFICADO = 1;
    const PAGO_NO_VERIFICADO = 0;
    public static function createPayment($pedido_id, $path_qr, $data, $movement_id){
        $payment = new Payment();
        $payment->pedido_id = $pedido_id;
        $payment->path_qr = $path_qr;
        $payment->data = json_encode($data);
        $payment->movement_id = $movement_id;
        $payment->save();
        return $payment;
    }
    public function pedido(){
        return $this->belongsTo(Pedido::class, 'pedido_id', 'id');
    }
}

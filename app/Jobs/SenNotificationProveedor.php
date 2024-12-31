<?php

namespace App\Jobs;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Utils\DeloWass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SenNotificationProveedor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $proveedor_id;
    protected $compra_id;
    /**
     * Create a new job instance.
     */
    public function __construct($proveedor_id, $compra_id)
    {
        $this->proveedor_id = $proveedor_id;
        $this->compra_id = $compra_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $proveedor = Proveedor::findOrfail($this->proveedor_id);
        $compra = Compra::findOrfail($this->compra_id);
        $message = "🟦 *VeriPagos* ✅

*💵Monto:* $compra->total Bs.
*PAGADO* ✅

*Código de pago:* $compra->id

*Pagado por:* $proveedor->name $proveedor->address
*Fecha y hora del pago:* $compra->fecha

> Gracias por su compra";
        DeloWass::enviarTexto($proveedor->cod.$proveedor->phone, $message);
    }
}
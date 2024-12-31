<?php

namespace App\Jobs;

use App\Models\Cliente;
use App\Models\Venta;
use App\Utils\DeloWass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SenNotificationClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $cliente_id;
    public $venta_id;
    /**
     * Create a new job instance.
     */
    public function __construct($cliente_id, $venta_id)
    {
        $this->cliente_id = $cliente_id;
        $this->venta_id = $venta_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $cliente = Cliente::findOrfail($this->cliente_id);
        $venta = Venta::findOrfail($this->venta_id);
        $message = "🟦 *Todo perno* ✅

*💵Monto:* $venta->total Bs.
*PAGADO* ✅

*Código de pago:* $venta->id

*Pagado por:* $cliente->name $cliente->address
*Fecha y hora del pago:* $venta->fecha

> Gracias por su compra";
        DeloWass::enviarTexto($cliente->cod.$cliente->phone, $message);
    }
}
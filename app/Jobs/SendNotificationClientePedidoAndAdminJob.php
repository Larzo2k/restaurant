<?php

namespace App\Jobs;

use App\Models\Cliente;
use App\Models\Configuration;
use App\Models\Pedido;
use App\Utils\DeloWass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationClientePedidoAndAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $cliente_id;
    public $pedido_id;
    public function __construct($cliente_id, $pedido_id)
    {
        $this->cliente_id = $cliente_id;
        $this->pedido_id = $pedido_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $cliente = Cliente::findOrfail($this->cliente_id);
        $pedido = Pedido::findOrfail($this->pedido_id);
        $configuracion = Configuration::first();
        $message = "🟦 *$configuracion->name* ✅

*💵Monto:* $pedido->total Bs.
*PAGADO* ✅

*Código de pago:* $pedido->nro_recibo

*Pagado por:* $cliente->name $cliente->address
*Fecha y hora del pago:* $pedido->fecha

> Gracias por su pedido";
        DeloWass::enviarArchivo(
            $cliente->cod . $cliente->phone,
            $message,
            "https://refactoring.guru/files/design-patterns-es-demo.pdf",
            // env("APP_URL").$venta->url_pdf, 
            "Comprobante de venta"
        );
        //admin
        DeloWass::enviarArchivo(
            $configuracion->cod . $configuracion->phone,
            $message,
            "https://refactoring.guru/files/design-patterns-es-demo.pdf",
            // env("APP_URL").$venta->url_pdf, 
            "Comprobante de venta"
        );
    }
}

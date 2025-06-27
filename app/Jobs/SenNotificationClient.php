<?php

namespace App\Jobs;

use App\Models\Cliente;
use App\Models\Configuration;
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
        $configuracion = Configuration::first();
        $message = "🟦 *$configuracion->name* ✅

*💵Monto:* $venta->total Bs.
*PAGADO* ✅

*Código de pago:* $venta->nro_recibo

*Pagado por:* $cliente->name $cliente->address
*Fecha y hora del pago:* $venta->fecha

> Gracias por su compra";
        DeloWass::enviarArchivo(
            $cliente->cod.$cliente->phone, 
            $message, 
            // "https://refactoring.guru/files/design-patterns-es-demo.pdf",
            env("APP_URL").$venta->url_pdf,
            "Comprobante de venta"
        );
        // Waziper::enviarArchivoEnMasivo(
        //     $configuracion->access_token_wsp,
        //     $condominio->instancia_wsp, 
        //     $cod_pais . $numero, 
        //     $mensajeTextoPlano,
        //     env("APP_URL").$this->expensa->url_aviso
        // );
    }
}
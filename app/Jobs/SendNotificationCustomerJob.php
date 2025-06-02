<?php

namespace App\Jobs;

use App\Models\Configuration;
use App\Models\Pedido;
use App\Utils\DeloWass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotificationCustomerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $pedido_id;
    protected $remitente;
    public function __construct( $pedido_id, $remitente)
    {
        $this->pedido_id = $pedido_id;
        $this->remitente = $remitente;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("SendNotificationAdminJob");
        Log::info('pedido' . $this->pedido_id);
        $pedido = Pedido::with('customer')->where('id', $this->pedido_id)->first();
        Log::info("pedido" . $pedido);
        $cliente = $pedido->customer;
        $configuration = Configuration::first();
        // $driverData = self::getDataDriver($driver_id);
        $message = "📢 *Nuevo pedido registrado*

👤 Cliente: *{$cliente->name}*
📄 Recibo N°: *{$pedido->nro_recibo}*
💵 Total pagado: *{$pedido->total} Bs*

✅ El pedido fue registrado con éxito y está listo para ser procesado.";
        $number = $configuration->code . $configuration->phone;
        DeloWass::enviarTexto($number, $message);
    }
}

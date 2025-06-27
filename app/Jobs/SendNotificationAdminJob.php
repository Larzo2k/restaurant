<?php

namespace App\Jobs;

use App\Models\Pedido;
use App\Utils\DeloWass;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotificationAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $pedido_id;
    protected $remitente;
    public function __construct($pedido_id, $remitente)
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
        // $driverData = self::getDataDriver($driver_id);
        $message = "✅ Estimado/a *{$cliente->name}*, su pedido fue realizado con éxito. 
Gracias por confiar en nosotros. 📦

🧾 Monto total: *{$pedido->total} Bs*
📄 Nro. de pedido: *{$pedido->nro_recibo}*

Nos comunicaremos pronto para más detalles";
        $number = $pedido->customer->cod . $pedido->customer->phone;
        //$number = "+59170906491";
        DeloWass::enviarTexto($number, $message);
    }
}

<?php

namespace App\Jobs;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GeneratePdfPedidoDownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $pedido_id;
    public function __construct($pedido_id)
    {
        $this->pedido_id = $pedido_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pedido = Pedido::findOrfail($this->pedido_id);
        $data = [
            'pedido' => $pedido,
        ];
        $añoA = date('Y');
        setlocale(LC_TIME, 'es_ES.UTF-8'); // Esto es importante para mostrar en español
        $fecha = Carbon::createFromDate(date('Y'), date('m'), 1);
        $nombreMes = $fecha->translatedFormat('F');
        $pdf = PDF::loadView('cliente.pedidos.pdf', $data);
        $pdfFileName = uniqid() . '.pdf';
        $pdfPath = 'public/pedidos/' . '/' . $añoA . '/' . $nombreMes . '/' . $pdfFileName;
        // Guardar el PDF en el almacenamiento
        Storage::put($pdfPath, $pdf->output());
        // Guardar la ruta del PDF en el campo url_aviso
        $pedido->url_pdf = Storage::url($pdfPath);
        Log::info('url_aviso' . Storage::url($pdfPath));
        $pedido->update();
    }
}

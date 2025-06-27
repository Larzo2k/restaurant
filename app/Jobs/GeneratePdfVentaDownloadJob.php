<?php

namespace App\Jobs;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GeneratePdfVentaDownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $venta_id;
    public function __construct($id)
    {
        $this->venta_id = $id;
    }

    /**
     * Execute the job.
     */
    // public function handle(): void
    // {
    //     $venta = Venta::findOrfail($this->venta_id);
    //     $data = [
    //         'venta' => $venta,
    //     ];
    //     $añoA = date('Y');
    //     setlocale(LC_TIME, 'es_ES.UTF-8'); // Esto es importante para mostrar en español
    //     $fecha = Carbon::createFromDate(date('Y'), date('m'), 1);
    //     $nombreMes = $fecha->translatedFormat('F');
    //     $pdf = PDF::loadView('admin.venta.pdf', $data);
    //     $pdfFileName = uniqid() . '.pdf';
    //     $pdfPath = 'public/ventas/'.'/'. $añoA .'/'. $nombreMes .'/'. $pdfFileName;
    //     // Guardar el PDF en el almacenamiento
    //     Storage::put($pdfPath, $pdf->output());
    //     // Guardar la ruta del PDF en el campo url_aviso
    //     $venta->url_pdf = Storage::url($pdfPath);
    //     Log::info('url_aviso'.Storage::url($pdfPath));
    //     $venta->update();
    // }

    public function handle(): void
    {
        $venta = Venta::findOrFail($this->venta_id);
        $data = ['venta' => $venta];

        // Configuración de fechas
        $añoActual = date('Y');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $nombreMes = Carbon::now()->translatedFormat('F');

        try {
            // Generar el PDF
            $pdf = PDF::loadView('admin.venta.pdf', $data);

            // Ruta en S3 (sin 'public/' y usando estructura limpia)
            $pdfPath = 'ventas/' . $añoActual . '/' . $nombreMes . '/' . Str::uuid() . '.pdf';

            // Guardar en S3 con visibilidad pública
            Storage::disk('s3')->put($pdfPath, $pdf->output(), [
                'visibility' => 'public',
                'ContentType' => 'application/pdf'
            ]);

            // Generar URL correcta (Cloudflare R2 específico)
            $pdfUrl = rtrim(env('AWS_URL'), '/') . '/' . ltrim($pdfPath, '/');

            // Alternativa usando el método url() si está bien configurado
            // $pdfUrl = Storage::disk('s3')->url($pdfPath);

            // Actualizar la venta
            $venta->update(['url_pdf' => $pdfUrl]);

            Log::info("PDF guardado correctamente en: {$pdfUrl}");
        } catch (\Exception $e) {
            Log::error("Error al guardar PDF: " . $e->getMessage());
            throw $e;
        }
    }
}
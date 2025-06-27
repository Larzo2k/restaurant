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
        $data = [
            'venta' => $venta,
        ];

        // Configuración de fechas y nombres
        $añoActual = date('Y');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fecha = Carbon::createFromDate(date('Y'), date('m'), 1);
        $nombreMes = $fecha->translatedFormat('F');

        try {
            // Generar el PDF
            $pdf = PDF::loadView('admin.venta.pdf', $data);

            // Crear estructura de carpetas y nombre de archivo
            $pdfFileName = 'ventas/' . $añoActual . '/' . $nombreMes . '/' . Str::uuid() . '.pdf';

            // Guardar el PDF en S3 (Cloudflare R2)
            Storage::disk('s3')->put(
                $pdfFileName,
                $pdf->output(),
                [
                    'visibility' => 'private', // O 'public' si quieres que sea accesible públicamente
                    'ContentType' => 'application/pdf'
                ]
            );

            // Obtener la URL del archivo (puedes usar signed URL si es privado)
            $pdfUrl = Storage::disk('s3')->url($pdfFileName);

            // Si el archivo es privado, genera una URL temporal
            // $pdfUrl = Storage::disk('s3')->temporaryUrl($pdfFileName, now()->addHours(24));

            // Actualizar la venta con la URL del PDF
            $venta->update([
                'url_pdf' => $pdfUrl
            ]);

            Log::info("PDF guardado en S3: {$pdfUrl}");
        } catch (\Exception $e) {
            Log::error("Error al generar y guardar PDF para venta {$this->venta_id}: " . $e->getMessage());
            throw $e; // O maneja el error según tus necesidades
        }
    }
}
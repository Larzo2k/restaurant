<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Pedido;
use App\Services\VeripagosService;
use App\Utils\Helpers;
use App\Utils\ResponseHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class QrController extends Controller
{
    protected $veripagosService;
    public function __construct(VeripagosService $veripagosService)
    {
        $this->veripagosService = $veripagosService;
    }

    public function generateQr(Request $request){
        DB::beginTransaction();
        try{
            $pedido = Pedido::findOrfail($request->pedido_id);
            $response = $this->veripagosService->generateQr($pedido->total, [$pedido->id]);
            $qrBase64 = 'data:image/png;base64,' . $response->qr;
            $path = Helpers::saveFileFromBase64($qrBase64, 'payment_instances');
            $dataToSave = [
                'payment_instance_id' => $response->movimiento_id,
                'pago' => $pedido->total,
                'customer_id' => $pedido->customer_id,
                'pedido_id' => $pedido->id,
            ];
            //guardar en la tabla los datos
            $qrPayment = Payment::createPayment($pedido->id, $path, $dataToSave, $response->movimiento_id);
            $movimientoId = $response->movimiento_id;
            DB::commit();
            return response()->json([
                "codigo" => 0, 
                'mensaje' => 'Qr generado', 
                'data' => [
                    'qr_image' => $path,    
                    'movimiento_id' => $movimientoId,           // El path actual
                    // 'payment_instance_id' => $payment_instance_id,       // Nueva imagen del QR generada
                    // 'user' => auth()->user(),      // Usuario que generó la reserva (si es necesario)
                    // 'timestamp' => now(),          // Hora de la respuesta o cualquier otra información adicional
                ]
            ]);
        }catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function verifyPayment(Request $request){
        try {
            $paymentMovimiento = $request->qrMovimiento;
            $payment = Payment::where('movement_id', $paymentMovimiento)->first();
            if($payment->is_pago == Payment::PAGO_NO_VERIFICADO){
                throw new \Exception('No se encontró la venta', 404);
            }
            return ResponseHandler::success(Response::HTTP_OK, 'Pago verificado exitosamente', null);
        } catch (\Exception $e) {
            return ResponseHandler::error($e->getCode(), $e->getMessage());
        }
    }
}

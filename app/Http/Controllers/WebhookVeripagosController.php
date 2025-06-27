<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotificationAdminJob;
use App\Jobs\SendNotificationCustomerJob;
use App\Models\Payment;
use App\Models\Pedido;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookVeripagosController extends Controller
{
    public function handleWebhook(Request $request)
    {
        try {
            Log::debug('Webhook Veripagos');
            Log::debug(json_encode($request->all()));
            Log::debug('se acaba de pagar');

            $movimientoId = $request['movimiento_id'];
            $total = $request['monto'];
            $paymentInstance = isset($request->data[0]) ? $request->data[0] : null;
            $payment = Payment::with('pedido')->where('movement_id', $movimientoId)->first();
            $remitente = isset($request->remitente['nombre']) ? $request->remitente['nombre'] : null;

            if ($payment->is_pago == Payment::PAGO_NO_VERIFICADO) {
                $payment->is_pago = Payment::PAGO_VERIFICADO;
                $payment->update();
                $pedido = Pedido::find($payment->pedido_id);
                $pedido->update(['is_pago' => Payment::PAGO_VERIFICADO]);
                //enviar notificaciones a administracion y cliente
                SendNotificationAdminJob::dispatch($pedido->id, $remitente);
                SendNotificationCustomerJob::dispatch($pedido->id, $remitente);
            }
            return new JsonResponse(true, 200);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            Log::debug($e->getTraceAsString());
            return new JsonResponse(true, 500);
        }
    }
}

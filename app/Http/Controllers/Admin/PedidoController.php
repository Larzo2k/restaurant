<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoController extends Controller
{
    public function index(){
        $pedidos = Pedido::get();
        return view('admin.pedido.index', compact('pedidos'));
    }
    public function getPdf($pedido_id)
    {
        try {
            $pedido = Pedido::findOrfail($pedido_id);
            $data = [
                'pedido' => $pedido,
            ];
            $pdf = PDF::loadView('cliente.pedidos.pdf', $data);
            return $pdf->stream('detalle_recibo.pdf');
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
}

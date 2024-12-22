<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::listaConPaginate();
        $json_paises = File::get(base_path() . '/database/data/paises.json');
        $paises = json_decode($json_paises);
        return view('admin.cliente.index', compact('clientes','paises'));
    }
    public function store(Request $request)
    {
        try{
            $ruta = Helpers::guardarImagen($request, 'clientes', 'imagen');
            Cliente::storeCliente($request->nombre, $request->apellido, $request->email, $request->cod_pais, $request->telefono, $ruta);
            return response()->json([
                'codigo' => 0,
                'data' => Cliente::listarView(),
                'mensaje' => 'Cliente creado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $ruta = Helpers::guardarImagen($request, 'clientes', 'imagen');
            Cliente::updateCliente($id, $request->nombre, $request->apellido, $request->email, $request->cod_pais, $request->telefono, $ruta);
            return response()->json([
                'codigo' => 0,
                'data' => Cliente::listarView(),
                'mensaje' => 'Cliente actualizado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function delete($id){
        try{
            $cliente = Cliente::deleteCliente($id);
            return response()->json([
                'codigo' => 0,
                'data' => Cliente::listarView(),
                'mensaje' => 'Cliente eliminado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
}
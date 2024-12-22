<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use App\Utils\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $proveedores = Proveedor::listaConPaginate();
        if($request->ajax()){
            $view = Proveedor::listarView($request);
            return response()->json([
                'codigo' => 0,
                'mensaje' => 'directivo listado exitosamente',
                'data' => $view
            ]);
        }
        $json_paises = File::get(base_path() . '/database/data/paises.json');
        $paises = json_decode($json_paises);
        return view('admin.proveedor.index', compact('proveedores','paises'));
    }
    public function store(Request $request)
    {
        try{
            $ruta = Helpers::guardarImagen($request, 'clientes', 'imagen');
            Proveedor::storeCliente($request->nombre, $request->apellido, $request->email, $request->cod_pais, $request->telefono, $ruta);
            return response()->json([
                'codigo' => 0,
                'data' => Proveedor::listarView(),
                'mensaje' => 'Cliente creado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function update(Request $request, $id)
    {
        try{
            // dd([
            //     'request' => $request->all(),
            //     'id' => $id
            // ]);
            $ruta = Helpers::guardarImagen($request, 'clientes', 'imagen');
            Proveedor::updateCliente($request->id, $request->nombre, $request->apellido, $request->email, $request->cod_pais, $request->telefono, $ruta);
            return response()->json([
                'codigo' => 0,
                'data' => Proveedor::listarView(),
                'mensaje' => 'Cliente actualizado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function delete($id){
        try{
            $cliente = Proveedor::deleteCliente($id);
            return response()->json([
                'codigo' => 0,
                'data' => Proveedor::listarView(),
                'mensaje' => 'Cliente eliminado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
}
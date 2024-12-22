<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function index(Request $request)
    {
        $almacenes = Almacen::listaConPaginate();
        if($request->ajax()){
            $view = Almacen::listarView($request);
            return response()->json([
                'codigo' => 0,
                'mensaje' => 'directivo listado exitosamente',
                'data' => $view
            ]);
        }
        return view('admin.almacen.index', compact('almacenes'));
    }
    public function store(Request $request)
    {
        try{
            Almacen::storeAlmacen($request->nombre);
            return response()->json([
                'codigo' => 0,
                'data' => Almacen::listarView(),
                'mensaje' => 'Cliente creado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function update(Request $request, $id)
    {
        // dd([
        //     'id' => $id,
        //     'request' => $request->all()
        // ]);
        try{
            Almacen::updateAlmacen($request->id, $request->nombre);
            return response()->json([
                'codigo' => 0,
                'data' => Almacen::listarView(),
                'mensaje' => 'Cliente actualizado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function delete($id){
        try{
            $cliente = Almacen::deleteAlmacen($id);
            return response()->json([
                'codigo' => 0,
                'data' => Almacen::listarView(),
                'mensaje' => 'Cliente eliminado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::listaConPaginate();
        if($request->ajax()){
            $view = Categoria::listarView($request);
            return response()->json([
                'codigo' => 0,
                'mensaje' => 'directivo listado exitosamente',
                'data' => $view
            ]);
        }
        return view('admin.categoria.index', compact('categorias'));
    }
    public function store(Request $request)
    {
        try{
            Categoria::storeCategoria($request->nombre);
            return response()->json([
                'codigo' => 0,
                'data' => Categoria::listarView(),
                'mensaje' => 'Categoria creado con exitosamente.'
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
            Categoria::updateCategoria($request->id, $request->nombre);
            return response()->json([
                'codigo' => 0,
                'data' => Categoria::listarView(),
                'mensaje' => 'Categoria actualizado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function delete($id){
        try{
            $cliente = Categoria::deleteCategoria($id);
            return response()->json([
                'codigo' => 0,
                'data' => Categoria::listarView(),
                'mensaje' => 'Categoria eliminado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
}
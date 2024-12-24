<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Nette\Schema\Helpers;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $productos = Producto::listaConPaginate();
        if($request->ajax()){
            $view = Producto::listarView($request);
            return response()->json([
                'codigo' => 0,
                'mensaje' => 'directivo listado exitosamente',
                'data' => $view
            ]);
        }
        $almacenes = Almacen::all();
        $categorias = Categoria::all();
        return view('admin.producto.index', compact('productos','almacenes','categorias'));
    }
    // public function store(Request $request)
    // {
    //     try{
    //         $ruta = Helpers::guardarImagen($request, 'clientes', 'imagen');
    //         Producto::storeProducto($request->nombre, $request->apellido, $request->email, $request->cod_pais, $request->telefono, $ruta);
    //         return response()->json([
    //             'codigo' => 0,
    //             'data' => Producto::listarView(),
    //             'mensaje' => 'Cliente creado con exitosamente.'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
    //     }
    // }
    // public function update(Request $request, $id)
    // {
    //     try{
    //         $ruta = Helpers::guardarImagen($request, 'clientes', 'imagen');
    //         Producto::updateProducto($id, $request->nombre, $request->apellido, $request->email, $request->cod_pais, $request->telefono, $ruta);
    //         return response()->json([
    //             'codigo' => 0,
    //             'data' => Producto::listarView(),
    //             'mensaje' => 'Cliente actualizado con exitosamente.'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
    //     }
    // }
    // public function delete($id){
    //     try{
    //         $cliente = Producto::deleteProducto($id);
    //         return response()->json([
    //             'codigo' => 0,
    //             'data' => Producto::listarView(),
    //             'mensaje' => 'Cliente eliminado con exitosamente.'
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
    //     }
    // }
}
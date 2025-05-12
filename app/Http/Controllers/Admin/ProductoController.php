<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Almacen;
use App\Models\Categoria;
use App\Models\Producto;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;

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
        $categorias = Categoria::all();
        return view('admin.producto.index', compact('productos','categorias'));
    }
    public function store(Request $request)
    {
        try{
            $existeCodigo = Producto::where('cod', $request->codigo)->exists();
            if($existeCodigo){
                return response()->json([
                    'codigo' => 1,
                    'data' => null,
                    'mensaje' => 'Codigo ya existe!'
                ]);
            }
            $ruta = Helpers::guardarImagen($request, 'productos', 'imagen');
            Producto::storeProducto($request->nombre, $request->codigo, $request->descripcion, $ruta, $request->categoria_id, 1, $request->price);
            return response()->json([
                'codigo' => 0,
                'data' => Producto::listarView(),
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
            Producto::updateProducto($request->id, $request->nombre, $request->descripcion, $ruta, $request->categoria_id);
            return response()->json([
                'codigo' => 0,
                'data' => Producto::listarView(),
                'mensaje' => 'Cliente actualizado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function delete($id){
        try{
            $cliente = Producto::deleteProducto($id);
            return response()->json([
                'codigo' => 0,
                'data' => Producto::listarView(),
                'mensaje' => 'Cliente eliminado con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
    public function getCodigo(Request $request){
        $data = $request->input('codigo');
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($data, $generator::TYPE_CODE_128);

        // Enviar el código de barras como imagen en base64 para que el frontend lo pueda mostrar
        $barcodeData = base64_encode($barcode);

        return response()->json(['barcode' => $barcodeData,'codigo' => 0, 'mensaje' => 'Código de barras generado exitosamente.']);
    }
    public function verifyCode(Request $request){
        $codigo = $request->input('codigo');
        $productoExistente = Producto::where('cod', $codigo)->exists();
        // Devolvemos una respuesta JSON
        if($productoExistente){
            return response()->json([
                'codigo' => 1, // El código existe
                'mensaje' => 'El código de producto ya está registrado.',
            ]);
        } else {
            return response()->json([
                'codigo' => 0, // El código no existe
                'mensaje' => 'El código de producto es válido para generar el código de barras.',
            ]);
        }
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Producto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'product';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'cod_barra',
        'description',
        'image',
        'price',
        'stock',
        'category_id',
        'supplier_id',
        'wherehouse_id',
        'status'
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public static function scopeListadoGeneral(Builder $query, Request $request = null)
    {
        return $query->when($request && $request->input('buscador'), function ($query) use ($request) {
                $buscador = $request->input('buscador');
                $query->where(function ($q) use ($buscador) {
                    $q->where('name', 'like', "%$buscador%");
                });
            })
            ->where('status', self::ESTADO_ACTIVO)
            ->paginate(10);
    }
    public static function listaConPaginate(Request $request = null){
        return self::listadoGeneral($request);
    }
    public static function listarView(Request $request = null){
        $productos = self::listadoGeneral($request);
        $view = view('admin.producto.table', compact('productos'))->render();
        return $view;
    }
    public static function storeProducto($name, $descripcion, $imagen, $price, $stock, $category_id, $supplier_id, $wherehouse_id, $status = self::ESTADO_ACTIVO){
        $producto = new self();
        $producto->id = Str::uuid();
        $producto->name = $name;
        $producto->cod_barra = self::generarCodigoBarra();
        $producto->description = $descripcion;
        $producto->image = $imagen;
        $producto->price = $price;
        $producto->stock = $stock;
        $producto->category_id = $category_id;
        $producto->supplier_id = $supplier_id;
        $producto->wherehouse_id = $wherehouse_id;
        $producto->status = $status;
        $producto->save();
    }
    public static function updateProducto($id, $name, $descripcion, $imagen, $price, $stock, $category_id, $supplier_id, $wherehouse_id, $status = self::ESTADO_ACTIVO){
        $cliente = self::find($id);
        $cliente->name = $name;
        $cliente->description = $descripcion;
        $cliente->image = $imagen;
        $cliente->price = $price;
        $cliente->stock = $stock;
        $cliente->category_id = $category_id;
        $cliente->supplier_id = $supplier_id;
        $cliente->wherehouse_id = $wherehouse_id;
        $cliente->status = $status;
        $cliente->update();
    }
    public static function deleteProducto($id){
        $cliente = self::find($id);
        $cliente->status = self::ESTADO_INACTIVO;
        $cliente->update();
    }
    public static function generarCodigoBarra(){
        $codigo = rand(1000000000000, 9999999999999);
        return $codigo;
    }
}
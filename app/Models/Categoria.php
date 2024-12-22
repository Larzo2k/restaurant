<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Categoria extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'category';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
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
        $categorias = self::listadoGeneral($request);
        $view = view('admin.categoria.table', compact('categorias'))->render();
        return $view;
    }
    public static function storeCategoria($name, $status = self::ESTADO_ACTIVO){
        $cliente = new self();
        $cliente->id = Str::uuid();
        $cliente->name = $name;
        $cliente->status = $status;
        $cliente->save();
    }
    public static function updateCategoria($id, $name){
        $cliente = self::find($id);
        $cliente->name = $name;
        $cliente->update();
    }
    public static function deleteCategoria($id){
        $cliente = self::find($id);
        $cliente->status = self::ESTADO_INACTIVO;
        $cliente->update();
    }
}
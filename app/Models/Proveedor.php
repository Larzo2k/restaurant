<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Proveedor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';
     protected $table = 'supplier';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'cod',
        'phone',
        'email',
        'image',
        'status'
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;

    public static function scopeListadoGeneral(Builder $query, Request $request = null)
    {
        return $query->when($request && $request->input('buscador'), function ($query) use ($request) {
                $buscador = $request->input('buscador');
                $query->where(function ($q) use ($buscador) {
                    $q->where('name', 'like', "%$buscador%")
                    ->orWhere('email', 'like', "%$buscador%")
                    ->orWhere('phone', 'like', "%$buscador%");
                });
            })
            ->where('status', self::ESTADO_ACTIVO)
            ->paginate(10);
    }
    public static function listaConPaginate(Request $request = null){
        return self::listadoGeneral($request);
    }
    public static function listarView(Request $request = null){
        $proveedores = self::listadoGeneral($request);
        $json_paises = File::get(base_path() . '/database/data/paises.json');
        $paises = json_decode($json_paises);
        $view = view('admin.proveedor.table', compact('proveedores', 'paises'))->render();
        return $view;
    }
    public static function storeCliente($name, $apellido, $email, $cod_pais, $telefono, $imagen, $status = self::ESTADO_ACTIVO){
        $cliente = new self();
        $cliente->id = Str::uuid();
        $cliente->name = $name;
        $cliente->address = $apellido;
        $cliente->email = $email;
        $cliente->phone = $telefono;
        $cliente->cod = $cod_pais;
        $cliente->image = $imagen;
        $cliente->status = $status;
        $cliente->save();
    }
    public static function updateCliente($id, $name, $apellido, $email, $cod_pais, $telefono, $imagen){
        $cliente = self::find($id);
        $cliente->name = $name;
        $cliente->address = $apellido;
        $cliente->email = $email;
        $cliente->phone = $telefono;
        $cliente->cod = $cod_pais;
        $cliente->image = $imagen;
        $cliente->save();
    }
    public static function deleteCliente($id){
        $cliente = self::find($id);
        $cliente->status = self::ESTADO_INACTIVO;
        $cliente->update();
    }
}
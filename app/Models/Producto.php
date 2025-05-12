<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;

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
        'stock',
        'category_id',
        'price',
        'status'
    ];
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    public function dailyMenuProduct()
    {
        return $this->hasOne(DailyMenuProduct::class, 'product_id')
                            ->where('status', 1);
    }
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
    public static function storeProducto($name, $cod, $descripcion, $imagen, $category_id, $status = self::ESTADO_ACTIVO, $price){
        $producto = new self();
        $producto->id = Str::uuid();
        $producto->name = $name;
        $producto->cod = $cod;
        $producto->cod_barra = self::generarCodigoBarra($cod, $name);
        $producto->description = $descripcion;
        $producto->image = $imagen;
        $producto->stock = 0;
        $producto->category_id = $category_id;
        $producto->status = $status;
        $producto->price = $price;
        $producto->save();
    }
    public static function updateProducto($id, $name, $descripcion, $imagen, $category_id, $status = self::ESTADO_ACTIVO){
        $cliente = self::find($id);
        $cliente->name = $name;
        $cliente->description = $descripcion;
        if($imagen != null){
            $cliente->image = $imagen;
        }
        $cliente->category_id = $category_id;
        $cliente->status = $status;
        $cliente->update();
    }
    public static function deleteProducto($id){
        $cliente = self::find($id);
        $cliente->status = self::ESTADO_INACTIVO;
        $cliente->update();
    }
    public function category(){
        return $this->belongsTo(Categoria::class, 'category_id', 'id');
    }
    public static function generarCodigoBarra($cod, $name){
        // $codigoBarrasData = base64_decode($cod);
        // $nombreArchivoCodigoBarras = $name.'_' . uniqid() . '.png';
        // $rutaCodigoBarras = Storage::put("public/codigos_barras/$nombreArchivoCodigoBarras", $codigoBarrasData);
        // dd($rutaCodigoBarras);
        // return $rutaCodigoBarras;
        if (str_starts_with($cod, 'data:image')) {
            $cod = substr($cod, strpos($cod, ',') + 1);
        }

        // Decodificar la base64
        $codigoBarrasData = base64_decode($cod);

        // Verificar si la decodificación fue exitosa
        if ($codigoBarrasData === false) {
            throw new \Exception('Los datos de la imagen no pudieron ser decodificados.');
        }

        // Crear un nombre único para el archivo
        $nombreArchivoCodigoBarras = $name . '_' . uniqid() . '.png';

        // Guardar la imagen en el almacenamiento
        $rutaCodigoBarras = Storage::put("public/codigos_barras/$nombreArchivoCodigoBarras", $codigoBarrasData);

        // Verificar si el archivo se guardó correctamente
        if (!$rutaCodigoBarras) {
            throw new \Exception('No se pudo guardar el archivo de la imagen.');
        }

        return "public/codigos_barras/$nombreArchivoCodigoBarras";
    }
    public static function verifyCode($code){
        $producto = self::where('cod', $code)->first();
        if($producto){
            return true;
        }else{
            return false;
        }
    }
    public function getCidogoBarraPng(){
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($this->cod, $generator::TYPE_CODE_128);

        // Nombre del archivo basado en el código
        $fileName = "codigos_barras/{$this->cod}.png";

        // Guardar el archivo solo si no existe
        if (!Storage::exists("public/{$fileName}")) {
            Storage::put("public/{$fileName}", $barcode);
        }

        // Retornar la URL del archivo
        return Storage::url($fileName);
    }
}
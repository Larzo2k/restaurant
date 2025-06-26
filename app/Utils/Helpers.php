<?php

namespace App\Utils;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helpers
{
    public static function guardarArchivo(Request $request, $folder, $inputName, $archivosPermitidos = [], $obligatorio = false)
    {
        if ($obligatorio && !$request->hasFile($inputName)) {
            throw new Exception("El archivo es requerido");
        } elseif (!$request->hasFile($inputName)) {
            return '';
        }

        $extension = $request->$inputName->getClientOriginalExtension();

        Log::debug($request->$inputName->extension());
        Log::debug($request->$inputName->getClientOriginalName());
        Log::debug($request->$inputName->getClientOriginalExtension() ?? 'holis');

        if (count($archivosPermitidos) > 0 && !in_array($extension, $archivosPermitidos)) {
            throw new Exception("Solo es aceptable archivos de tipo " . implode(", ", $archivosPermitidos));
        }

        $nombre = uniqid() . '.' . $extension;
        Storage::disk('public')->putFileAs($folder, $request->$inputName, $nombre);
        $path = "storage/$folder/" . $nombre;
        return $path;
    }

    // public static function guardarImagen(Request $request, $folder, $field_name)
    // {
    //     // if (!$request->hasFile($field_name)) {
    //     //     return ''; // Si no hay archivo, retornar vacío
    //     // }

    //     // $file = $request->file($field_name);
    //     // $extension = $file->extension();

    //     // // Verificar que el archivo tenga una extensión permitida
    //     // if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
    //     //     throw new Exception("Solo es aceptable png, jpg, jpeg");
    //     // }

    //     // // Generar un nombre único para el archivo
    //     // $nombre = Str::uuid() . '.' . $extension;

    //     // // Guardar el archivo en la carpeta especificada dentro del disco público
    //     // Storage::disk('public')->putFileAs($folder, $file, $nombre);

    //     // // Crear la ruta relativa para el archivo guardado
    //     // $path = "storage/$folder/" . $nombre;

    //     // return $path;
    //     if (!$request->hasFile($field_name)) {
    //         return ''; // Si no hay archivo, retornar vacío
    //     }

    //     $file = $request->file($field_name);
    //     $extension = $file->extension();

    //     if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
    //         throw new \Exception("Solo es aceptable png, jpg, jpeg");
    //     }

    //     $nombre = Str::uuid() . '.' . $extension;

    //     // Usamos el disco 'bucket' que está configurado con S3 o Laravel Cloud Storage
    //     Storage::disk('bucket')->putFileAs($folder, $file, $nombre, 'public');

    //     // Puedes construir la URL completa si es un bucket público
    //     $url = Storage::disk('bucket')->url("$folder/$nombre");

    //     return $url;
    // }
    // public static function guardarImagen(Request $request, $folder, $field_name)
    // {
    //     if (!$request->hasFile($field_name)) {
    //         return '';
    //     }

    //     $file = $request->file($field_name);
    //     $extension = $file->extension();

    //     if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
    //         throw new \Exception("Solo se acepta png, jpg, jpeg");
    //     }

    //     $nombre = \Str::uuid() . '.' . $extension;

    //     Storage::disk('bucket')->putFileAs($folder, $file, $nombre, 'public');

    //     return Storage::disk('bucket')->url("$folder/$nombre");
    // }
    public static function guardarImagen(Request $request)
    {
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('imagenes', 's3');

            // Hacerla pública (si quieres)
            Storage::disk('s3')->setVisibility($path, 'public');

            // Obtener la URL
            $url = Storage::disk('s3')->url($path);

            return response()->json([
                'url' => $url,
            ]);
        }

        return response()->json(['error' => 'No se subió ninguna imagen'], 400);
    }
    public static function saveFileFromBase64(String $base64File, String $folder)
    {
        $dataInfo = explode(";base64,", $base64File);
        $dataExt = str_replace('data:image/', '', $dataInfo[0]);
        $dataFile = str_replace(' ', '+', $dataInfo[1]);
        $image = base64_decode($dataFile);

        $nombre = $folder . '/' . uniqid() . '.' . $dataExt;
        Storage::disk('public')->put($nombre, $image);
        $path = "storage/" . $nombre;
        return $path;
    }
}
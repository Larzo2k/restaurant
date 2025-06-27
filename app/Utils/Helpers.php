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
    //     if (!$request->hasFile($field_name)) {
    //         return ''; // Si no hay archivo, retornar vacío
    //     }

    //     $file = $request->file($field_name);
    //     $extension = $file->extension();

    //     // Verificar que el archivo tenga una extensión permitida
    //     if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
    //         throw new Exception("Solo es aceptable png, jpg, jpeg");
    //     }

    //     // Generar un nombre único para el archivo
    //     $nombre = Str::uuid() . '.' . $extension;

    //     // Guardar el archivo en la carpeta especificada dentro del disco público
    //     Storage::disk('public')->putFileAs($folder, $file, $nombre);

    //     // Crear la ruta relativa para el archivo guardado
    //     $path = "storage/$folder/" . $nombre;

    //     return $path;
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

    // public static function guardarImagen(Request $request)
    // {
    //     if ($request->hasFile('imagen')) {
    //         // $path = $request->file('imagen')->storeP('imagenes', 's3');
    //         $path = $request->file('imagen')->storePublicly('imagenes', 's3');
    //         // Hacerla pública (si quieres)
    //         Storage::disk('s3')->setVisibility($path, 'public');

    //         // Obtener la URL
    //         // $url = Storage::disk('s3')->url($path);
    //         $url = env('AWS_ENDPOINT') . '/' . env('AWS_BUCKET') . '/' . $path;
    //         dd($url);
    //         return $url;
    //         // return response()->json([
    //         //     'url' => $url,
    //         // ]);
    //     }

    //     return response()->json(['error' => 'No se subió ninguna imagen'], 400);
    // }

    public static function guardarImagen(Request $request)
    {
        $request->validate([
            'imagen' => 'required|file|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');

                // Genera un nombre único
                $fileName = 'imagenes/' . uniqid() . '.' . $file->extension();

                // Sube el archivo con visibilidad pública
                Storage::disk('s3')->put($fileName, file_get_contents($file), 'public');

                // Obtén la URL correctamente formada
                $url = Storage::disk('s3')->url($fileName);

                return $url;
            }
        } catch (\Exception $e) {
            \Log::error('Error al subir imagen: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error al subir la imagen',
                'details' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }

        return response()->json(['error' => 'No se subió ninguna imagen'], 400);
    }
    public static function guardarImagenConfigurations(Request $request)
    {
        $request->validate([
            'avatar' => 'required|file|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imagen_login' => 'required|file|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'favicon' => 'required|file|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
            $uploadedImages = [];

            // Procesar cada imagen
            $imageTypes = [
                'avatar' => 'configuraciones/avatar',
                'imagen_login' => 'configuraciones/login',
                'favicon' => 'configuraciones/favicon'
            ];

            foreach ($imageTypes as $field => $folder) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $extension = $file->extension();

                    // Generar nombre único manteniendo la estructura de carpetas
                    $fileName = $folder . '/' . uniqid() . '.' . $extension;

                    // Subir con visibilidad pública
                    Storage::disk('s3')->put($fileName, file_get_contents($file), 'public');

                    // Guardar la URL
                    $uploadedImages[$field] = Storage::disk('s3')->url($fileName);
                }
            }

            // Verificar que se subieron todas las imágenes requeridas
            if (count($uploadedImages) !== count($imageTypes)) {
                throw new \Exception('No se pudieron subir todas las imágenes requeridas');
            }

            return $uploadedImages;
        } catch (\Exception $e) {
            \Log::error('Error al subir imágenes de configuración: ' . $e->getMessage());
            throw $e; // Relanzar la excepción para manejo en el controlador
        }
    }
    // public static function saveFileFromBase64(String $base64File, String $folder)
    // {
    //     $dataInfo = explode(";base64,", $base64File);
    //     $dataExt = str_replace('data:image/', '', $dataInfo[0]);
    //     $dataFile = str_replace(' ', '+', $dataInfo[1]);
    //     $image = base64_decode($dataFile);

    //     $nombre = $folder . '/' . uniqid() . '.' . $dataExt;
    //     Storage::disk('public')->put($nombre, $image);
    //     $path = "storage/" . $nombre;
    //     return $path;
    // }
    public static function saveFileFromBase64(string $base64File, string $folder): string
    {
        try {
            // Validar que el string base64 tenga el formato correcto
            if (!preg_match('/^data:image\/(\w+);base64,/', $base64File, $matches)) {
                throw new \InvalidArgumentException('Formato base64 inválido. Debe comenzar con "data:image/[extensión];base64,"');
            }

            // Extraer la extensión y los datos binarios
            $extension = $matches[1];
            $base64Data = substr($base64File, strpos($base64File, ',') + 1);
            $imageData = base64_decode($base64Data);

            // Validar que la decodificación fue exitosa
            if ($imageData === false) {
                throw new \RuntimeException('Error al decodificar el string base64');
            }

            // Generar nombre único y seguro para el archivo
            $fileName = $folder . '/' . Str::uuid() . '.' . $extension;

            // Guardar en Cloudflare R2 (S3) con visibilidad pública
            Storage::disk('s3')->put($fileName, $imageData, [
                'visibility' => 'public',
                'ContentType' => 'image/' . $extension
            ]);

            // Obtener la URL pública del archivo
            return Storage::disk('s3')->url($fileName);
        } catch (\Exception $e) {
            \Log::error('Error al guardar archivo base64: ' . $e->getMessage());
            throw $e; // Puedes personalizar el manejo de errores según tus necesidades
        }
    }
}
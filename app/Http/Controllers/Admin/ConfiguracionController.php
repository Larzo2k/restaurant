<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones = Configuration::first();
        $json_paises = File::get(base_path() . '/database/data/paises.json');
        $paises = json_decode($json_paises);
        return view('admin.configuracion.index', compact('configuraciones', 'paises'));
    }

    public function update(Request $request)
    {
        try {
            // Subir todas las imágenes
            $uploadedImages = Helpers::guardarImagenConfigurations($request);

            // Actualizar configuración
            Configuration::updateConfiguration(
                $request->name,
                $request->telefono,
                $request->cod_pais,
                $request->access_token_wsp,
                $uploadedImages['imagen_login'],
                $uploadedImages['avatar'],
                $uploadedImages['favicon']
            );
        //     dd($request->all());
        // //guardar imagen
        //     $logotipo = Helpers::guardarImagenConfigurations($request->avatar, 'configuraciones', 'avatar');
        //     $favicon = Helpers::guardarImagenConfigurations($request->favicon, 'configuraciones', 'favicon');
        //     $image = Helpers::guardarImagenConfigurations($request->imagen_login, 'configuraciones', 'imagen_login');
        //     Configuration::updateConfiguration($request->name, $request->telefono, $request->cod_pais, $request->access_token_wsp, $image, $logotipo, $favicon);
            return response()->json([
                'codigo' => 0,
                'data' => Configuration::first(),
                'mensaje' => 'Configuración actualizada con exitosamente.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'codigo' => 1,
                'mensaje' => $th->getMessage(),
                'data' => null
            ]);
        }
    }
}
<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    public function showLogin()
    {
        if(Auth::guard('cliente')->check()) {
            return redirect()->route('cliente.products.index');
        }
        return view('cliente.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('cliente')->attempt($credentials)) {
            // if ($request->ajax()) {
            //     return response()->json([
            //         'codigo' => 0,
            //         'mensaje' => 'Bienvenido',
            //         'redirect_url' => route('propietario.dashboard')
            //     ]);
            // }
            // dd("entro");
            // return view('cliente.products.index');
            return redirect()->route('cliente.products.index');
        }

        if ($request->ajax()) {
            return response()->json([
                'codigo' => 1,
                'mensaje' => 'Credenciales incorrectos'
            ]);
        }
        return back()->withErrors(['error' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        Auth::guard('cliente')->logout();
        return redirect('login-cliente');
    }
    public function register()
    {
        $json_paises = File::get(base_path() . '/database/data/paises.json');
        $paises = json_decode($json_paises);
        return view('cliente.auth.register', compact('paises'));
    }
    public function registerCliente(Request $request)
    {
        try{
            $request->validate([
                'nombre' => 'required|string|max:255',
                'addres' => 'required|string|max:255',
                'cod_pais' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|email|unique:customer,email', // Asegura que el email no esté repetido
                'password' => 'required|min:6',
            ]);
            $ruta = '';
            $cliente = Cliente::storeCliente($request->nombre, $request->addres, $request->email, $request->cod_pais, $request->phone, $ruta, $request->password);
            Auth::guard('cliente')->login($cliente);

            // Redirigir a su dashboard
            return redirect()->route('cliente.products.index');

        } catch (\Throwable $th) {
            return response()->json(["codigo" => 1, 'mensaje' => $th->getMessage(), "data" => null]);
        }
    }
}

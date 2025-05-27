<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}

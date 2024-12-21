<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function showLogin()
    {
        return view('admin.auth.login');
    }
    public function auth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => User::ESTADO_ACTIVO], true)) {
            return redirect()->to('admin');
        }

        return back()->withErrors([
            'error' => '!! Por favor verifique sus credenciales !!',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('admin');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //<--seguridad de laravel(Auth)

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }
     //verifica si es el pin correcto
     public function login(Request $request)
     {
        //aqui validamos que llegue el correo y contraseña
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Auth::attempt() verifica las credenciales
        if (auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('projects.index');
        }
        //si falla la autenticacion, se redirige al login con un mensaje de error
        return back()->with('error', ('Correo o contraseña incorrectos'));

     }

    public function logout(Request $request)
    {
        auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

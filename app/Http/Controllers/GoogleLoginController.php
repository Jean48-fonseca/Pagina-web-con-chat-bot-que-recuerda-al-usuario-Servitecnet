<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    //Google devuelve los datos del usuario
    public function handleGoogleCallback()
    {
      try{
        $googleUser = Socialite::driver('google')->user();

        //Se busca si el Google_Id existe sino, lo creamos.
        $user = User::updateOrCreate(
            ['google_id' => $googleUser->id],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
            ]
        );
        //se inicia sesion con ese usuario
        Auth::Login($user);
        
        //Los mandamos al welcomeBlade
        return redirect('/');

      } catch (\Exception $e) {
        return redirect('/admin/login')->with('error', 'Error al iniciar sesión con Google');
         
        }
      }
}
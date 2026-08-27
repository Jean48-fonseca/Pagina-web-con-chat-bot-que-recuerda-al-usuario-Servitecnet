<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PinMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
      //revisa si esta logeado en el sistema
       if (!auth()->check()){
        return redirect()->route('admin.login');

       }
     //Revisa si tiene privilegio de Administrador
        if (auth()->user()->role !== 'admin'){
          //si no es admin, redirige a la pagina de inicio
          auth()->logout();
          return redirect()->route('admin.login')->with('error','No tienes permisos para acceder');

        }
        //si es admin, permite el acceso a la ruta
        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class UserMiddleware 
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'user') {
                return $next($request);
            } else {
                return redirect(url('login'))->with('error', 'No tienes permiso para acceder a esta página.');
            }
        } else {
            return redirect(url('login'))->with('error', 'Por favor inicia sesión.');
        }
    }
}

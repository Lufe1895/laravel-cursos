<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if(!$request->user()->hasRole($roles)){
            throw new \Exception('No tiene permiso para acceder a esta ruta.', 500);
        }
        return $next($request);
    }
}

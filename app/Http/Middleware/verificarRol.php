<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarRol
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $rolUsuario = session('usuario_rol');

        if (!in_array($rolUsuario, $roles)) {
            abort(403, 'No tienes permiso para hacer esto');
        }

        return $next($request);
    }
}
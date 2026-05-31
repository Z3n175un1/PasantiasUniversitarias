<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            abort(403, 'No autenticado');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            $roleId = match ($role) {
                'admin', 'administrador' => 3,
                'company', 'empresa' => 2,
                'student', 'estudiante' => 1,
                default => (int) $role,
            };

            if ($user->rol_id == $roleId) {
                return $next($request);
            }
        }

        abort(403, 'No tienes permisos para acceder a esta sección.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistroAuditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $usuario = Auth::user();

        if ($usuario->correo !== 'prueba@edu.bo') {
            abort(403, 'Solo el administrador principal puede acceder a los logs.');
        }

        $query = RegistroAuditoria::with(['usuario', 'tipoEntidad']);

        if ($request->filled('usuario')) {
            $query->where('usuario_id', $request->usuario);
        }

        if ($request->filled('accion')) {
            $query->where('accion', 'like', "%{$request->accion}%");
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('creado_en', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('creado_en', '<=', $request->fecha_hasta);
        }

        $logs = $query->orderBy('creado_en', 'desc')->paginate(30);

        $usuarios = \App\Models\Usuario::where('rol_id', 3)->orderBy('nombre')->get();

        return view('admin.logs', compact('logs', 'usuarios'));
    }
}

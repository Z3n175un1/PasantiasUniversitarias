<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfertaPasantia;
use App\Models\PerfilEmpresa;
use App\Models\PerfilEstudiante;
use App\Models\RegistroAuditoria;
use App\Models\TipoEntidad;
use App\Models\Usuario;
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

        if ($request->filled('tipo_entidad')) {
            $query->where('tipo_entidad_id', $request->tipo_entidad);
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

        $usuarios = Usuario::where('rol_id', 3)->orderBy('nombre')->get();
        $tiposEntidad = TipoEntidad::orderBy('nombre')->get();

        $entidades = [];
        foreach ($logs as $log) {
            $entidades[$log->id] = $this->obtenerEntidad($log);
        }

        return view('admin.logs', compact('logs', 'usuarios', 'tiposEntidad', 'entidades'));
    }

    private function obtenerEntidad(RegistroAuditoria $log): ?array
    {
        return match ((int) $log->tipo_entidad_id) {
            1 => $this->datosUsuario($log->entidad_id),
            2 => $this->datosEmpresa($log->entidad_id),
            3 => $this->datosEstudiante($log->entidad_id),
            4 => $this->datosOferta($log->entidad_id),
            default => null,
        };
    }

    private function datosUsuario(int $id): ?array
    {
        $user = Usuario::find($id);
        if (!$user) return null;
        return [
            'nombre' => trim("{$user->nombre} {$user->ap_paterno} {$user->ap_materno}"),
            'correo' => $user->correo,
            'url' => route('admin.usuarios.editar', $user->id),
        ];
    }

    private function datosEmpresa(int $userId): ?array
    {
        $perfil = PerfilEmpresa::with('usuario')->where('usuario_id', $userId)->first();
        if (!$perfil) return null;
        return [
            'nombre' => $perfil->nombre_empresa,
            'correo' => $perfil->usuario->correo ?? 'N/A',
            'url' => null,
        ];
    }

    private function datosEstudiante(int $userId): ?array
    {
        $perfil = PerfilEstudiante::with('usuario')->where('usuario_id', $userId)->first();
        if (!$perfil) return null;
        return [
            'nombre' => $perfil->usuario ? trim("{$perfil->usuario->nombre} {$perfil->usuario->ap_paterno} {$perfil->usuario->ap_materno}") : 'N/A',
            'correo' => $perfil->usuario->correo ?? 'N/A',
            'url' => null,
        ];
    }

    private function datosOferta(int $id): ?array
    {
        $oferta = OfertaPasantia::with('perfilEmpresa')->find($id);
        if (!$oferta) return null;
        return [
            'nombre' => $oferta->titulo,
            'empresa' => $oferta->perfilEmpresa->nombre_empresa ?? 'N/A',
            'url' => route('pasantia.show', $oferta->id),
        ];
    }

    public function exportar($formato, Request $request)
    {
        $usuario = Auth::user();
        if ($usuario->correo !== 'prueba@edu.bo') {
            abort(403);
        }

        $query = RegistroAuditoria::with(['usuario', 'tipoEntidad']);

        if ($request->filled('usuario')) $query->where('usuario_id', $request->usuario);
        if ($request->filled('tipo_entidad')) $query->where('tipo_entidad_id', $request->tipo_entidad);
        if ($request->filled('accion')) $query->where('accion', 'like', "%{$request->accion}%");
        if ($request->filled('fecha_desde')) $query->whereDate('creado_en', '>=', $request->fecha_desde);
        if ($request->filled('fecha_hasta')) $query->whereDate('creado_en', '<=', $request->fecha_hasta);

        $items = $query->orderBy('creado_en', 'desc')->get();

        $headers = ['ID', 'Usuario', 'Acción', 'Tipo Entidad', 'Entidad ID', 'Fecha'];
        $rows = [];
        foreach ($items as $item) {
            $rows[] = [
                $item->id,
                $item->usuario->nombre ?? 'N/A',
                $item->accion,
                $item->tipoEntidad->nombre ?? 'N/A',
                $item->entidad_id,
                $item->creado_en ? \Carbon\Carbon::parse($item->creado_en)->format('d/m/Y H:i') : 'N/A',
            ];
        }

        if ($formato === 'csv') {
            $callback = function () use ($headers, $rows) {
                $file = fopen('php://output', 'w');
                fputs($file, "\xEF\xBB\xBF");
                fputcsv($file, $headers, ',');
                foreach ($rows as $row) {
                    fputcsv($file, $row, ',');
                }
                fclose($file);
            };

            return response()->stream($callback, 200, [
                'Content-Type' => 'text/csv; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="logs_sistema_' . date('Y-m-d') . '.csv"',
            ]);
        }

        return back()->with('error', 'Formato no soportado.');
    }
}

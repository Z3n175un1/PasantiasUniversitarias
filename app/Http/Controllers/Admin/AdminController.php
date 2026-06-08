<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfertaPasantia;
use App\Models\Postulacion;
use App\Models\PerfilEmpresa;
use App\Models\PerfilEstudiante;
use App\Models\RegistroAuditoria;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'usuarios' => Usuario::count(),
            'empresas' => PerfilEmpresa::count(),
            'estudiantes' => PerfilEstudiante::count(),
            'ofertas' => OfertaPasantia::count(),
            'postulaciones' => Postulacion::count(),
            'ultimos_usuarios' => Usuario::with('rol')->latest('creado_en')->take(10)->get(),
        ];

        $distribucion = [
            'estudiantes' => PerfilEstudiante::count(),
            'empresas' => PerfilEmpresa::count(),
            'admins' => Usuario::where('rol_id', 3)->count(),
        ];

        $ofertas_recientes = OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion'])
            ->orderBy('id', 'desc')->take(5)->get();

        $ultimos_logs = RegistroAuditoria::with('usuario')
            ->orderBy('creado_en', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'distribucion', 'ofertas_recientes', 'ultimos_logs'));
    }

    // ── CRUD Usuarios ──────────────────────────────────────────────────────────

    public function usuarios()
    {
        $usuarios = Usuario::with('rol')->latest('creado_en')->paginate(20);
        return view('admin.usuarios', compact('usuarios'));
    }

    public function crearUsuario()
    {
        $roles = Rol::all();
        return view('admin.usuarios-crear', compact('roles'));
    }

    public function guardarUsuario(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'ap_paterno' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'ap_materno' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:8',
            'rol_id' => 'required|exists:roles,id',
        ]);

        if ($request->rol_id == 2) {
            $request->validate([
                'nombre_empresa' => 'required|string|max:200',
                'industria' => 'required|string|max:100',
                'telefono' => 'nullable|string|max:30',
                'direccion' => 'nullable|string|max:255',
            ]);
        } elseif ($request->rol_id == 1) {
            $request->validate([
                'universidad' => 'required|string|max:200',
                'carrera' => 'required|string|max:200',
                'fecha_nacimiento' => 'nullable|date',
            ]);
        }

        $usuario = Usuario::create([
            'rol_id' => $request->rol_id,
            'nombre' => $request->nombre,
            'ap_paterno' => $request->ap_paterno,
            'ap_materno' => $request->ap_materno,
            'correo' => $request->correo,
            'contrasena_hash' => Hash::make($request->password),
            'activo' => true,
        ]);

        if ($request->rol_id == 2) {
            PerfilEmpresa::create([
                'usuario_id' => $usuario->id,
                'nombre_empresa' => $request->nombre_empresa,
                'industria' => $request->industria,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'sitio_web' => null,
                'verificada' => false,
            ]);
        } elseif ($request->rol_id == 1) {
            PerfilEstudiante::create([
                'usuario_id' => $usuario->id,
                'universidad' => $request->universidad,
                'carrera' => $request->carrera,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'anio_graduacion' => null,
                'biografia' => null,
            ]);
        }

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 1,
            'entidad_id' => $usuario->id,
            'accion' => 'Creación de usuario',
            'valor_nuevo' => [
                'nombre' => $usuario->nombre,
                'ap_paterno' => $usuario->ap_paterno,
                'ap_materno' => $usuario->ap_materno,
                'correo' => $usuario->correo,
                'rol_id' => $usuario->rol_id,
                'activo' => true,
            ],
            'creado_en' => now(),
        ]);

        return redirect()->route('admin.usuarios')->with('success', '¡Bien hecho! Usuario creado correctamente. :D');
    }

    public function editarUsuario($id)
    {
        $usuario = Usuario::with('rol')->findOrFail($id);
        $roles = Rol::all();
        $empresa = PerfilEmpresa::where('usuario_id', $id)->first();
        $estudiante = PerfilEstudiante::where('usuario_id', $id)->first();
        $ubicaciones = \App\Models\Ubicacion::all();
        $carreras = \App\Models\Habilidad::select('categoria')->whereNotNull('categoria')->distinct()->pluck('categoria');
        return view('admin.usuarios-editar', compact('usuario', 'roles', 'empresa', 'estudiante', 'ubicaciones', 'carreras'));
    }

    public function actualizarUsuario(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $original = $usuario->getOriginal();

        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'ap_paterno' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'ap_materno' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
            'rol_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:8',
        ]);

        if ($request->rol_id == 2) {
            $request->validate([
                'nombre_empresa' => 'required|string|max:200',
                'industria' => 'required|string|max:100',
                'telefono' => 'nullable|string|max:30',
                'direccion' => 'nullable|string|max:255',
            ]);
        } elseif ($request->rol_id == 1) {
            $request->validate([
                'universidad' => 'required|string|max:200',
                'carrera' => 'required|string|max:200',
                'fecha_nacimiento' => 'nullable|date',
            ]);
        }

        $cambios = [
            'nombre' => $request->nombre,
            'ap_paterno' => $request->ap_paterno,
            'ap_materno' => $request->ap_materno,
            'correo' => $request->correo,
            'rol_id' => $request->rol_id,
        ];

        $usuario->nombre = $request->nombre;
        $usuario->ap_paterno = $request->ap_paterno;
        $usuario->ap_materno = $request->ap_materno;
        $usuario->correo = $request->correo;
        $usuario->rol_id = $request->rol_id;

        if ($request->filled('password')) {
            $usuario->contrasena_hash = Hash::make($request->password);
            $cambios['contrasena_hash'] = $usuario->contrasena_hash;
        }

        $usuario->save();

        if ($request->rol_id == 2) {
            PerfilEmpresa::updateOrCreate(
                ['usuario_id' => $usuario->id],
                [
                    'nombre_empresa' => $request->nombre_empresa,
                    'industria' => $request->industria,
                    'telefono' => $request->telefono,
                    'direccion' => $request->direccion,
                ]
            );
        } elseif ($request->rol_id == 1) {
            PerfilEstudiante::updateOrCreate(
                ['usuario_id' => $usuario->id],
                [
                    'universidad' => $request->universidad,
                    'carrera' => $request->carrera,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                ]
            );
        }

        $anterior = array_intersect_key($original, $cambios);

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 1,
            'entidad_id' => $usuario->id,
            'accion' => 'Modificación de usuario',
            'valor_anterior' => $anterior,
            'valor_nuevo' => $cambios,
            'creado_en' => now(),
        ]);

        return redirect()->route('admin.usuarios')->with('success', '¡Bien hecho! Usuario actualizado correctamente. :D');
    }

    public function eliminarUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->correo === 'prueba@edu.bo') {
            return back()->with('error', 'No se puede eliminar al administrador principal.');
        }

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 1,
            'entidad_id' => $usuario->id,
            'accion' => 'Eliminación de usuario',
            'valor_anterior' => [
                'nombre' => $usuario->nombre,
                'ap_paterno' => $usuario->ap_paterno,
                'ap_materno' => $usuario->ap_materno,
                'correo' => $usuario->correo,
                'rol_id' => $usuario->rol_id,
                'activo' => $usuario->activo,
            ],
            'creado_en' => now(),
        ]);

        $usuario->delete();

        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado correctamente.');
    }

    public function toggleUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $estadoAnterior = $usuario->activo;

        if ($usuario->correo === 'prueba@edu.bo') {
            return back()->with('error', 'No se puede desactivar al administrador principal.');
        }

        $usuario->activo = !$usuario->activo;
        $usuario->save();

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 1,
            'entidad_id' => $usuario->id,
            'accion' => ($usuario->activo ? 'Activación' : 'Desactivación') . ' de usuario',
            'valor_anterior' => ['activo' => $estadoAnterior],
            'valor_nuevo' => ['activo' => $usuario->activo],
            'creado_en' => now(),
        ]);

        $accion = $usuario->activo ? 'activado' : 'desactivado';
        return back()->with('success', "Usuario {$accion} correctamente.");
    }

    // ── Empresas ───────────────────────────────────────────────────────────────

    public function empresas()
    {
        $empresas = PerfilEmpresa::with('usuario')->get();
        return view('admin.empresas', compact('empresas'));
    }

    public function toggleEmpresa($id)
    {
        $empresa = PerfilEmpresa::findOrFail($id);
        $estadoAnterior = $empresa->verificada;
        $empresa->verificada = !$empresa->verificada;
        $empresa->save();

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 2,
            'entidad_id' => $empresa->usuario_id,
            'accion' => ($empresa->verificada ? 'Verificación' : 'Desverificación') . ' de empresa',
            'valor_anterior' => ['verificada' => $estadoAnterior],
            'valor_nuevo' => ['verificada' => $empresa->verificada],
            'creado_en' => now(),
        ]);

        $accion = $empresa->verificada ? 'verificada' : 'desverificada';
        return back()->with('success', "Empresa {$accion} correctamente.");
    }

    // ── Estudiantes ────────────────────────────────────────────────────────────

    public function estudiantes()
    {
        $estudiantes = PerfilEstudiante::with('usuario')->get();
        return view('admin.estudiantes', compact('estudiantes'));
    }

    // ── Ofertas ────────────────────────────────────────────────────────────────

    public function ofertas()
    {
        $ofertas = OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion', 'requisitosHabilidad.habilidad'])->get();
        return view('admin.ofertas', compact('ofertas'));
    }

    public function toggleOferta($id)
    {
        $oferta = OfertaPasantia::findOrFail($id);
        $estadoActual = $oferta->estado_publicacion_id;
        $oferta->estado_publicacion_id = $estadoActual == 1 ? 2 : 1;
        $oferta->save();

        $estados = [1 => 'Abierta', 2 => 'Cerrada'];

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 4,
            'entidad_id' => $oferta->id,
            'accion' => 'Cambio de estado de oferta',
            'valor_anterior' => ['estado_publicacion_id' => $estados[$estadoActual] ?? $estadoActual],
            'valor_nuevo' => ['estado_publicacion_id' => $estados[$oferta->estado_publicacion_id] ?? $oferta->estado_publicacion_id],
            'creado_en' => now(),
        ]);

        return back()->with('success', 'Estado de la oferta actualizado.');
    }

    // ── Reportes Dinámicos ─────────────────────────────────────────────────────

    public function reportes(Request $request)
    {
        $tipo = $request->get('tipo', 'usuarios');
        $fecha_desde = $request->get('fecha_desde');
        $fecha_hasta = $request->get('fecha_hasta');

        $data = [];

        switch ($tipo) {
            case 'usuarios':
                $query = Usuario::with('rol');
                if ($fecha_desde) $query->whereDate('creado_en', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('creado_en', '<=', $fecha_hasta);
                $data['items'] = $query->orderBy('creado_en', 'desc')->get();
                $data['titulo'] = 'Reporte de Usuarios';
                $data['columnas'] = ['ID', 'Nombre', 'Correo', 'Rol', 'Activo', 'Registro'];
                break;

            case 'ofertas':
                $query = OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion']);
                if ($fecha_desde) $query->whereDate('fecha_inicio', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('fecha_inicio', '<=', $fecha_hasta);
                $data['items'] = $query->orderBy('id', 'desc')->get();
                $data['titulo'] = 'Reporte de Ofertas';
                $data['columnas'] = ['ID', 'Título', 'Empresa', 'Ubicación', 'Estado', 'Inicio'];
                break;

            case 'postulaciones':
                $query = Postulacion::with(['perfilEstudiante.usuario', 'ofertaPasantia']);
                if ($fecha_desde) $query->whereDate('creado_en', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('creado_en', '<=', $fecha_hasta);
                $data['items'] = $query->orderBy('id', 'desc')->get();
                $data['titulo'] = 'Reporte de Postulaciones';
                $data['columnas'] = ['ID', 'Estudiante', 'Oferta', 'Estado', 'Puntaje', 'Fecha'];
                break;

            case 'logs':
                $query = RegistroAuditoria::with(['usuario', 'tipoEntidad']);
                if ($fecha_desde) $query->whereDate('creado_en', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('creado_en', '<=', $fecha_hasta);
                $data['items'] = $query->orderBy('creado_en', 'desc')->get();
                $data['titulo'] = 'Reporte de Actividad';
                $data['columnas'] = ['ID', 'Usuario', 'Acción', 'Tipo', 'Fecha'];
                break;
        }

        return view('admin.reportes', compact('data', 'tipo', 'fecha_desde', 'fecha_hasta'));
    }

    // ── Estadísticas ───────────────────────────────────────────────────────────

    public function estadisticas()
    {
        $total_usuarios = Usuario::count();
        $total_empresas = PerfilEmpresa::count();
        $total_estudiantes = PerfilEstudiante::count();
        $total_ofertas = OfertaPasantia::count();
        $total_postulaciones = Postulacion::count();

        $distribucion_roles = [
            'labels' => ['Estudiantes', 'Empresas', 'Administradores'],
            'data' => [
                $total_estudiantes,
                $total_empresas,
                Usuario::where('rol_id', 3)->count(),
            ],
        ];

        $ofertas_por_mes = collect();

        return view('admin.estadisticas', compact(
            'total_usuarios', 'total_empresas', 'total_estudiantes',
            'total_ofertas', 'total_postulaciones',
            'distribucion_roles', 'ofertas_por_mes'
        ));
    }
}

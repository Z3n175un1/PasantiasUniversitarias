<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfertaPasantia;
use App\Models\Postulacion;
use App\Models\PerfilEmpresa;
use App\Models\PerfilEstudiante;
use App\Models\RegistroAuditoria;
use App\Models\RequisitoHabilidadOferta;
use App\Models\Rol;
use App\Models\Ubicacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admins = Usuario::where('rol_id', 3)->count();
        $stats = [
            'usuarios' => Usuario::count(),
            'empresas' => PerfilEmpresa::count(),
            'estudiantes' => PerfilEstudiante::count(),
            'ofertas' => OfertaPasantia::count(),
            'postulaciones' => Postulacion::count(),
            'admins' => $admins,
            'ultimos_usuarios' => Usuario::with('rol')->latest('creado_en')->take(10)->get(),
        ];

        $distribucion = [
            'estudiantes' => PerfilEstudiante::count(),
            'empresas' => PerfilEmpresa::count(),
            'admins' => $admins,
        ];

        $ofertas_recientes = OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion'])
            ->orderBy('id', 'desc')->take(5)->get();

        $ultimos_logs = RegistroAuditoria::with('usuario')
            ->orderBy('creado_en', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'distribucion', 'ofertas_recientes', 'ultimos_logs'));
    }

    // ── CRUD Usuarios ──────────────────────────────────────────────────────────

    public function usuarios(Request $request)
    {
        $search = $request->get('search');
        $usuarios = Usuario::with('rol')
            ->when($search, function ($q, $search) {
                $q->where('nombre', 'ilike', "%{$search}%")
                  ->orWhere('ap_paterno', 'ilike', "%{$search}%")
                  ->orWhere('ap_materno', 'ilike', "%{$search}%")
                  ->orWhere('correo', 'ilike', "%{$search}%");
            })
            ->latest('creado_en')->paginate(20);
        $esSuperAdmin = Auth::user()->correo === 'prueba@edu.bo';
        return view('admin.usuarios', compact('usuarios', 'esSuperAdmin'));
    }

    public function crearUsuario()
    {
        $esSuperAdmin = Auth::user()->correo === 'prueba@edu.bo';
        $roles = $esSuperAdmin
            ? Rol::all()
            : Rol::whereIn('id', [1, 2])->get();
        return view('admin.usuarios-crear', compact('roles'));
    }

    public function guardarUsuario(Request $request)
    {
        $esSuperAdmin = Auth::user()->correo === 'prueba@edu.bo';
        $rolPermitido = $esSuperAdmin ? [1, 2, 3] : [1, 2];

        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'ap_paterno' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'ap_materno' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:8',
            'rol_id' => 'required|in:' . (is_array($rolPermitido) ? implode(',', $rolPermitido) : $rolPermitido),
        ], [
            'rol_id.in' => 'No tienes permiso para asignar ese rol.',
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
                'fecha_nacimiento' => 'nullable|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d') . '|after_or_equal:' . now()->subYears(30)->format('Y-m-d'),
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
        $esSuperAdmin = Auth::user()->correo === 'prueba@edu.bo';

        if ($usuario->correo === 'prueba@edu.bo' && !$esSuperAdmin) {
            return redirect()->route('admin.usuarios')->with('error', 'No tienes permiso para editar al superadministrador.');
        }
        $roles = $esSuperAdmin
            ? Rol::all()
            : Rol::whereIn('id', [1, 2])->get();
        $empresa = PerfilEmpresa::where('usuario_id', $id)->first();
        $estudiante = PerfilEstudiante::where('usuario_id', $id)->first();
        $ubicaciones = \App\Models\Ubicacion::all();
        $carreras = \App\Models\Habilidad::select('categoria')->whereNotNull('categoria')->distinct()->pluck('categoria');
        return view('admin.usuarios-editar', compact('usuario', 'roles', 'empresa', 'estudiante', 'ubicaciones', 'carreras', 'esSuperAdmin'));
    }

    public function actualizarUsuario(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $original = $usuario->getOriginal();

        $esSuperAdmin = Auth::user()->correo === 'prueba@edu.bo';

        if ($usuario->correo === 'prueba@edu.bo' && !$esSuperAdmin) {
            return redirect()->route('admin.usuarios')->with('error', 'No tienes permiso para editar al superadministrador.');
        }
        $rolPermitido = $esSuperAdmin ? [1, 2, 3] : [1, 2];

        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'ap_paterno' => ['required', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'ap_materno' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
            'rol_id' => 'required|in:' . (is_array($rolPermitido) ? implode(',', $rolPermitido) : $rolPermitido),
            'password' => 'nullable|min:8',
        ], [
            'rol_id.in' => 'No tienes permiso para asignar ese rol.',
        ]);

        if ($request->rol_id == 2) {
            $request->validate([
                'nombre_empresa' => 'required|string|max:200',
                'industria' => 'required|string|max:100',
                'telefono' => 'nullable|numeric|digits_between:7,15',
                'direccion' => 'nullable|string|max:255',
            ]);
        } elseif ($request->rol_id == 1) {
            $request->validate([
                'universidad' => 'required|string|max:200',
                'carrera' => 'required|string|max:200',
                'fecha_nacimiento' => 'nullable|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d') . '|after_or_equal:' . now()->subYears(30)->format('Y-m-d'),
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
        $ubicaciones = Ubicacion::all();
        $carreras = [
            'Administración de Empresas', 'Administración Turística y Hotelera', 'Agronomía',
            'Antropología', 'Arqueología', 'Arquitectura', 'Artes Plásticas', 'Auditoría',
            'Bioquímica', 'Biotecnología', 'Ciencia de la Computación', 'Ciencia Política',
            'Ciencias de la Comunicación', 'Ciencias de la Educación', 'Ciencias del Deporte',
            'Contabilidad', 'Derecho', 'Diseño de Interiores', 'Diseño Digital', 'Diseño Gráfico',
            'Economía', 'Enfermería', 'Filosofía', 'Física', 'Fisioterapia', 'Geografía',
            'Historia', 'Idiomas / Lingüística', 'Ingeniería Agroindustrial', 'Ingeniería Agronómica',
            'Ingeniería Ambiental', 'Ingeniería Biomédica', 'Ingeniería Civil', 'Ingeniería Comercial',
            'Ingeniería de Alimentos', 'Ingeniería de Sistemas', 'Ingeniería de Telecomunicaciones',
            'Ingeniería Económica', 'Ingeniería Eléctrica', 'Ingeniería Electrónica',
            'Ingeniería en Biotecnología', 'Ingeniería en Energías Renovables', 'Ingeniería Forestal',
            'Ingeniería Geológica', 'Ingeniería Industrial', 'Ingeniería Informática',
            'Ingeniería Mecánica', 'Ingeniería Mecatrónica', 'Ingeniería Metalúrgica',
            'Ingeniería Petrolera', 'Ingeniería Química', 'Ingeniería Textil', 'Ingeniería Topográfica',
            'Literatura', 'Marketing', 'Matemáticas', 'Medicina', 'Medicina Veterinaria', 'Música',
            'Negocios Internacionales', 'Nutrición', 'Odontología', 'Pedagogía', 'Periodismo',
            'Psicología', 'Química', 'Relaciones Internacionales', 'Sociología', 'Trabajo Social',
            'Turismo y Hotelería',
        ];
        return view('admin.ofertas', compact('ofertas', 'ubicaciones', 'carreras'));
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

    public function mostrarOferta($id)
    {
        $oferta = OfertaPasantia::with(['requisitosHabilidad.habilidad', 'ubicacion', 'perfilEmpresa'])->findOrFail($id);
        return response()->json($oferta->makeVisible(['requisitos', 'beneficios', 'vacantes_disponibles', 'duracion_semanas']));
    }

    public function actualizarOferta(Request $request, $id)
    {
        $oferta = OfertaPasantia::findOrFail($id);
        $original = $oferta->getOriginal();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'modalidad' => 'required|string|in:Presencial,Remoto,Híbrido',
            'carrera' => 'nullable|string|max:200',
            'requisitos' => 'nullable|string|max:5000',
            'beneficios' => 'nullable|string|max:5000',
            'vacantes_disponibles' => 'nullable|integer|min:1|max:999',
            'duracion_semanas' => 'nullable|integer|min:1|max:156',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $campos = ['titulo', 'descripcion', 'ubicacion_id', 'modalidad', 'carrera', 'requisitos', 'beneficios', 'vacantes_disponibles', 'duracion_semanas', 'fecha_inicio', 'fecha_fin'];
        $nuevos = $request->only($campos);
        $oferta->update($nuevos);

        $anterior = array_intersect_key($original, $nuevos);

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 4,
            'entidad_id' => $oferta->id,
            'accion' => 'Modificación de oferta (admin)',
            'valor_anterior' => $anterior,
            'valor_nuevo' => $nuevos,
            'creado_en' => now(),
        ]);

        return redirect()->route('admin.ofertas')->with('success', 'Oferta actualizada correctamente.');
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
                $data['columnas'] = ['ID', 'Nombre(s)', 'Ap. Paterno', 'Ap. Materno', 'Correo', 'Rol', 'Activo', 'Registro'];
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
                $data['columnas'] = ['ID', 'Nombre(s)', 'Ap. Paterno', 'Ap. Materno', 'Oferta', 'Estado', 'Puntaje', 'Fecha'];
                break;

            case 'logs':
                $query = RegistroAuditoria::with(['usuario', 'tipoEntidad']);
                if ($fecha_desde) $query->whereDate('creado_en', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('creado_en', '<=', $fecha_hasta);
                $data['items'] = $query->orderBy('creado_en', 'desc')->get();
                $data['titulo'] = 'Reporte de Actividad';
                $data['columnas'] = ['ID', 'Nombre(s)', 'Ap. Paterno', 'Ap. Materno', 'Acción', 'Tipo', 'Fecha'];
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

        $mesActual = now()->format('Y-m');
        $ofertas_mes = OfertaPasantia::whereRaw("to_char(fecha_inicio, 'YYYY-MM') = ?", [$mesActual])->count();

        return view('admin.estadisticas', compact(
            'total_usuarios', 'total_empresas', 'total_estudiantes',
            'total_ofertas', 'total_postulaciones',
            'distribucion_roles', 'ofertas_mes'
        ));
    }

    // ── Respaldos ───────────────────────────────────────────────────────────────

    public function respaldos()
    {
        $backupPath = storage_path('app/backups');
        $backups = [];
        if (is_dir($backupPath)) {
            $files = \File::files($backupPath);
            $backups = array_map(function ($file) {
                return [
                    'name' => $file->getFilename(),
                    'size' => $file->getSize(),
                    'date' => date('d/m/Y H:i', $file->getMTime()),
                ];
            }, $files);
            rsort($backups);
        }

        $dbSize = 0;
        try {
            $dbSize = \DB::select("SELECT pg_database_size(current_database()) as size")[0]->size ?? 0;
        } catch (\Exception $e) {
            $dbSize = 0;
        }

        return view('admin.respaldos', compact('backups', 'dbSize'));
    }

    public function generarRespaldo(Request $request)
    {
        $dbName = env('DB_DATABASE', 'pasantias_db');
        $dbUser = env('DB_USERNAME', 'postgres');
        $dbPass = env('DB_PASSWORD', '');
        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbPort = env('DB_PORT', '5432');

        $backupDir = storage_path('app/backups');
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $backupDir . '/' . $filename;

        $pgDumpPath = env('PG_DUMP_PATH');

        if (!$pgDumpPath) {
            $possiblePaths = [
                'C:\Program Files\PostgreSQL\17\bin\pg_dump.exe',
                'C:\Program Files\PostgreSQL\16\bin\pg_dump.exe',
                'C:\Program Files\PostgreSQL\15\bin\pg_dump.exe',
                '/usr/bin/pg_dump',
                '/usr/local/bin/pg_dump',
            ];

            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    $pgDumpPath = $path;
                    break;
                }
            }
        }

        if (!$pgDumpPath) {
            $pgDumpPath = 'pg_dump';
        }

        $command = sprintf(
            '%s --host=%s --port=%s --username=%s --dbname=%s --no-password --file=%s 2>&1',
            escapeshellarg($pgDumpPath),
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($dbUser),
            escapeshellarg($dbName),
            escapeshellarg($filepath)
        );

        putenv("PGPASSWORD={$dbPass}");
        $output = null;
        $returnCode = null;
        exec($command, $output, $returnCode);
        putenv('PGPASSWORD');

        if ($returnCode === 0 && file_exists($filepath)) {
            RegistroAuditoria::create([
                'usuario_id' => Auth::id(),
                'tipo_entidad_id' => 6,
                'entidad_id' => 0,
                'accion' => 'Respaldo de base de datos generado',
                'valor_nuevo' => ['archivo' => $filename, 'tamano' => filesize($filepath)],
                'creado_en' => now(),
            ]);

            return redirect()->route('admin.respaldos')->with('success', 'Respaldo generado correctamente: ' . $filename);
        }

        return redirect()->route('admin.respaldos')->with('error', 'Error al generar el respaldo: ' . implode("\n", $output));
    }

    public function descargarRespaldo($archivo)
    {
        $backupDir = storage_path('app/backups');
        $filepath = $backupDir . '/' . basename($archivo);

        if (!file_exists($filepath)) {
            return back()->with('error', 'El archivo de respaldo no existe.');
        }

        return response()->download($filepath, basename($archivo));
    }

    // ── Exportar Reportes ───────────────────────────────────────────────────────

    public function exportarReportes($formato, Request $request)
    {
        $tipo = $request->query('tipo', 'usuarios');
        $fecha_desde = $request->query('fecha_desde');
        $fecha_hasta = $request->query('fecha_hasta');

        $headers = [];
        $rows = [];
        $filename = '';

        switch ($tipo) {
            case 'usuarios':
                $query = Usuario::with('rol');
                if ($fecha_desde) $query->whereDate('creado_en', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('creado_en', '<=', $fecha_hasta);
                $items = $query->orderBy('id', 'desc')->get();
                $headers = ['ID', 'Nombre(s)', 'Ap. Paterno', 'Ap. Materno', 'Correo', 'Rol', 'Activo', 'Fecha Registro'];
                foreach ($items as $item) {
                    $rows[] = [
                        $item->id,
                        $item->nombre ?? '',
                        $item->ap_paterno ?? '',
                        $item->ap_materno ?? '',
                        $item->correo,
                        $item->rol->nombre ?? 'N/A',
                        $item->activo ? 'Sí' : 'No',
                        $item->creado_en ? \Carbon\Carbon::parse($item->creado_en)->format('d/m/Y H:i') : 'N/A',
                    ];
                }
                $filename = 'reporte_usuarios';
                break;

            case 'ofertas':
                $query = OfertaPasantia::with(['perfilEmpresa', 'ubicacion', 'estadoPublicacion']);
                if ($fecha_desde) $query->whereDate('fecha_inicio', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('fecha_inicio', '<=', $fecha_hasta);
                $items = $query->orderBy('id', 'desc')->get();
                $headers = ['ID', 'Título', 'Empresa', 'Ubicación', 'Estado', 'Fecha Inicio'];
                foreach ($items as $item) {
                    $rows[] = [
                        $item->id,
                        $item->titulo,
                        $item->perfilEmpresa->nombre_empresa ?? 'N/A',
                        $item->ubicacion->ciudad ?? 'Remoto',
                        $item->estadoPublicacion->nombre ?? 'N/A',
                        $item->fecha_inicio ? \Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y') : 'N/A',
                    ];
                }
                $filename = 'reporte_ofertas';
                break;

            case 'postulaciones':
                $query = Postulacion::with(['perfilEstudiante.usuario', 'ofertaPasantia']);
                if ($fecha_desde) $query->whereDate('creado_en', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('creado_en', '<=', $fecha_hasta);
                $items = $query->orderBy('id', 'desc')->get();
                $headers = ['ID', 'Nombre(s)', 'Ap. Paterno', 'Ap. Materno', 'Oferta', 'Estado', 'Puntaje TOPSIS', 'Fecha'];
                foreach ($items as $item) {
                    $rows[] = [
                        $item->id,
                        $item->perfilEstudiante->usuario->nombre ?? '',
                        $item->perfilEstudiante->usuario->ap_paterno ?? '',
                        $item->perfilEstudiante->usuario->ap_materno ?? '',
                        $item->ofertaPasantia->titulo ?? 'N/A',
                        $item->estadoPostulacion->nombre ?? 'N/A',
                        $item->puntaje_topsis ?? '—',
                        $item->creado_en ? \Carbon\Carbon::parse($item->creado_en)->format('d/m/Y H:i') : 'N/A',
                    ];
                }
                $filename = 'reporte_postulaciones';
                break;

            case 'logs':
                $query = RegistroAuditoria::with(['usuario', 'tipoEntidad']);
                if ($fecha_desde) $query->whereDate('creado_en', '>=', $fecha_desde);
                if ($fecha_hasta) $query->whereDate('creado_en', '<=', $fecha_hasta);
                $items = $query->orderBy('creado_en', 'desc')->get();
                $headers = ['ID', 'Nombre(s)', 'Ap. Paterno', 'Ap. Materno', 'Acción', 'Tipo Entidad', 'Entidad ID', 'Valor Anterior', 'Valor Nuevo', 'Fecha'];
                foreach ($items as $item) {
                    $rows[] = [
                        $item->id,
                        $item->usuario->nombre ?? '',
                        $item->usuario->ap_paterno ?? '',
                        $item->usuario->ap_materno ?? '',
                        $item->accion,
                        $item->tipoEntidad->nombre ?? 'N/A',
                        $item->entidad_id ?? '—',
                        is_array($item->valor_anterior) ? json_encode($item->valor_anterior) : ($item->valor_anterior ?? '—'),
                        is_array($item->valor_nuevo) ? json_encode($item->valor_nuevo) : ($item->valor_nuevo ?? '—'),
                        $item->creado_en ? \Carbon\Carbon::parse($item->creado_en)->format('d/m/Y H:i') : 'N/A',
                    ];
                }
                $filename = 'reporte_logs';
                break;

            default:
                return back()->with('error', 'Tipo de reporte no válido para exportación.');
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
                'Content-Disposition' => 'attachment; filename="' . $filename . '_' . date('Y-m-d') . '.csv"',
            ]);
        }

        if ($formato === 'html') {
            $html = view('admin.reportes_printable', compact('headers', 'rows', 'tipo', 'filename'))->render();
            return response($html, 200, [
                'Content-Type' => 'text/html; charset=utf-8',
                'Content-Disposition' => 'inline; filename="' . $filename . '_' . date('Y-m-d') . '.html"',
            ]);
        }

        return back()->with('error', 'Formato no soportado.');
    }
}

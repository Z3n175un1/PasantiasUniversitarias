<?php

namespace App\Http\Controllers;

use App\Models\DocumentoEstudiante;
use App\Models\EstadoPostulacion;
use App\Models\Habilidad;
use App\Models\HabilidadEstudiante;
use App\Models\OfertaPasantia;
use App\Models\PerfilEmpresa;
use App\Models\Postulacion;
use App\Models\RegistroAuditoria;
use App\Models\RequisitoHabilidadOferta;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function dashboard()
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::with('usuario')->where('usuario_id', Auth::id())->firstOrFail();
        $ofertas = OfertaPasantia::with(['ubicacion', 'estadoPublicacion', 'requisitosHabilidad.habilidad'])
            ->where('perfil_empresa_id', $empresa->id)
            ->orderBy('id', 'desc')
            ->get();

        $total_postulantes = Postulacion::whereIn('oferta_pasantia_id', $ofertas->pluck('id'))->count();
        $todas_postulaciones = Postulacion::with([
                'perfilEstudiante.usuario',
                'perfilEstudiante.documentos.tipoDocumento',
                'perfilEstudiante.habilidades.habilidad',
                'ofertaPasantia',
                'estadoPostulacion'
            ])
            ->whereIn('oferta_pasantia_id', $ofertas->pluck('id'))
            ->orderBy('id', 'desc')
            ->get();

        $postulaciones_recientes = $todas_postulaciones->take(5);
        $estados_postulacion = EstadoPostulacion::all();
        $ubicaciones = Ubicacion::all();

        $carreras = [
            'Administración de Empresas',
            'Administración Turística y Hotelera',
            'Agronomía',
            'Antropología',
            'Arqueología',
            'Arquitectura',
            'Artes Plásticas',
            'Auditoría',
            'Bioquímica',
            'Biotecnología',
            'Ciencia de la Computación',
            'Ciencia Política',
            'Ciencias de la Comunicación',
            'Ciencias de la Educación',
            'Ciencias del Deporte',
            'Contabilidad',
            'Derecho',
            'Diseño de Interiores',
            'Diseño Digital',
            'Diseño Gráfico',
            'Economía',
            'Enfermería',
            'Filosofía',
            'Física',
            'Fisioterapia',
            'Geografía',
            'Historia',
            'Idiomas / Lingüística',
            'Ingeniería Agroindustrial',
            'Ingeniería Agronómica',
            'Ingeniería Ambiental',
            'Ingeniería Biomédica',
            'Ingeniería Civil',
            'Ingeniería Comercial',
            'Ingeniería de Alimentos',
            'Ingeniería de Sistemas',
            'Ingeniería de Telecomunicaciones',
            'Ingeniería Económica',
            'Ingeniería Eléctrica',
            'Ingeniería Electrónica',
            'Ingeniería en Biotecnología',
            'Ingeniería en Energías Renovables',
            'Ingeniería Forestal',
            'Ingeniería Geológica',
            'Ingeniería Industrial',
            'Ingeniería Informática',
            'Ingeniería Mecánica',
            'Ingeniería Mecatrónica',
            'Ingeniería Metalúrgica',
            'Ingeniería Petrolera',
            'Ingeniería Química',
            'Ingeniería Textil',
            'Ingeniería Topográfica',
            'Literatura',
            'Marketing',
            'Matemáticas',
            'Medicina',
            'Medicina Veterinaria',
            'Música',
            'Negocios Internacionales',
            'Nutrición',
            'Odontología',
            'Pedagogía',
            'Periodismo',
            'Psicología',
            'Química',
            'Relaciones Internacionales',
            'Sociología',
            'Trabajo Social',
            'Turismo y Hotelería',
        ];
        $modalidades = ['Presencial', 'Remoto', 'Híbrido'];
        $habilidades = Habilidad::orderBy('nombre')->get();

        return view('paneles-control.dashboard_company', compact(
            'empresa', 'ofertas', 'total_postulantes',
            'todas_postulaciones', 'postulaciones_recientes',
            'estados_postulacion', 'ubicaciones', 'carreras', 'modalidades',
            'habilidades'
        ));
    }

    public function guardarOferta(Request $request)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();

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
            'estado_publicacion_id' => 'nullable|exists:estados_publicacion,id',
            'habilidades' => 'nullable|array',
            'habilidades.*.habilidad_id' => 'required|exists:habilidades,id',
            'habilidades.*.nivel_minimo' => 'required|integer|min:1|max:5',
            'habilidades.*.peso' => 'required|numeric|min:0|max:100',
            'habilidades.*.tipo_criterio' => 'required|in:benefit,cost',
        ]);

        if ($request->has('habilidades')) {
            $suma = collect($request->habilidades)->sum('peso');
            if (round($suma) != 100) {
                return back()->withErrors(['habilidades' => 'Los pesos de las habilidades deben sumar 100%'])->withInput();
            }
        }

        $oferta = OfertaPasantia::create([
            'perfil_empresa_id' => $empresa->id,
            'ubicacion_id' => $request->ubicacion_id,
            'estado_publicacion_id' => $request->estado_publicacion_id ?? 1,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'modalidad' => $request->modalidad,
            'carrera' => $request->carrera,
            'requisitos' => $request->requisitos,
            'beneficios' => $request->beneficios,
            'vacantes_disponibles' => $request->vacantes_disponibles ?? 1,
            'duracion_semanas' => $request->duracion_semanas,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        if ($request->has('habilidades')) {
            foreach ($request->habilidades as $req) {
                RequisitoHabilidadOferta::create([
                    'oferta_pasantia_id' => $oferta->id,
                    'habilidad_id' => $req['habilidad_id'],
                    'nivel_minimo' => $req['nivel_minimo'],
                    'peso' => $req['peso'],
                    'tipo_criterio' => $req['tipo_criterio'],
                ]);
            }
        }

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 4,
            'entidad_id' => $oferta->id,
            'accion' => 'Creación de oferta',
            'valor_nuevo' => [
                'titulo' => $oferta->titulo,
                'descripcion' => $oferta->descripcion,
                'fecha_inicio' => $oferta->fecha_inicio,
                'fecha_fin' => $oferta->fecha_fin,
            ],
            'creado_en' => now(),
        ]);

        return redirect()->route('dashboard.company')->with('success', '¡Bien hecho! Publicaste tu oferta correctamente. :D');
    }

    public function actualizarOferta(Request $request, $id)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();
        $oferta = OfertaPasantia::where('id', $id)->where('perfil_empresa_id', $empresa->id)->firstOrFail();
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
            'estado_publicacion_id' => 'nullable|exists:estados_publicacion,id',
            'habilidades' => 'nullable|array',
            'habilidades.*.habilidad_id' => 'required|exists:habilidades,id',
            'habilidades.*.nivel_minimo' => 'required|integer|min:1|max:5',
            'habilidades.*.peso' => 'required|numeric|min:0|max:100',
            'habilidades.*.tipo_criterio' => 'required|in:benefit,cost',
        ]);

        if ($request->has('habilidades')) {
            $suma = collect($request->habilidades)->sum('peso');
            if (round($suma) != 100) {
                return back()->withErrors(['habilidades' => 'Los pesos de las habilidades deben sumar 100%'])->withInput();
            }
        }

        $campos = ['titulo', 'descripcion', 'ubicacion_id', 'modalidad', 'carrera', 'requisitos', 'beneficios', 'vacantes_disponibles', 'duracion_semanas', 'fecha_inicio', 'fecha_fin', 'estado_publicacion_id'];
        $nuevos = $request->only($campos);
        $oferta->update($nuevos);

        $oferta->requisitosHabilidad()->delete();
        if ($request->has('habilidades')) {
            foreach ($request->habilidades as $req) {
                RequisitoHabilidadOferta::create([
                    'oferta_pasantia_id' => $oferta->id,
                    'habilidad_id' => $req['habilidad_id'],
                    'nivel_minimo' => $req['nivel_minimo'],
                    'peso' => $req['peso'],
                    'tipo_criterio' => $req['tipo_criterio'],
                ]);
            }
        }

        $anterior = array_intersect_key($original, $nuevos);

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 4,
            'entidad_id' => $oferta->id,
            'accion' => 'Modificación de oferta',
            'valor_anterior' => $anterior,
            'valor_nuevo' => $nuevos,
            'creado_en' => now(),
        ]);

        return redirect()->route('dashboard.company')->with('success', '¡Bien hecho! Actualizaste tu oferta correctamente. :D');
    }

    public function eliminarOferta($id)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();
        $oferta = OfertaPasantia::where('id', $id)->where('perfil_empresa_id', $empresa->id)->firstOrFail();

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 4,
            'entidad_id' => $oferta->id,
            'accion' => 'Eliminación de oferta',
            'valor_anterior' => [
                'titulo' => $oferta->titulo,
                'descripcion' => $oferta->descripcion,
                'fecha_inicio' => $oferta->fecha_inicio,
                'fecha_fin' => $oferta->fecha_fin,
            ],
            'creado_en' => now(),
        ]);

        $oferta->delete();

        return redirect()->route('dashboard.company')->with('success', 'Oferta eliminada correctamente.');
    }

    public function actualizarPerfil(Request $request)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();

        $request->validate([
            'nombre_empresa' => 'required|string|max:200',
            'industria' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:2000',
            'telefono' => 'nullable|string|max:30',
            'direccion' => 'nullable|string|max:255',
            'tamano_empresa' => 'nullable|string|in:Pequeña,Mediana,Grande',
            'anio_fundacion' => 'nullable|integer|min:1800|max:' . date('Y'),
            'sitio_web' => 'nullable|url|max:255',
        ]);

        $empresa->update($request->only([
            'nombre_empresa', 'industria', 'descripcion', 'telefono',
            'direccion', 'tamano_empresa', 'anio_fundacion', 'sitio_web',
        ]));

        return back()->with('success', '¡Bien hecho! Actualizaste los datos de tu empresa correctamente. :D');
    }

    public function cambiarEstadoPostulacion(Request $request, $id)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();
        $postulacion = Postulacion::with('ofertaPasantia', 'estadoPostulacion')
            ->where('id', $id)
            ->whereHas('ofertaPasantia', function ($q) use ($empresa) {
                $q->where('perfil_empresa_id', $empresa->id);
            })
            ->firstOrFail();

        $request->validate([
            'estado_postulacion_id' => 'required|exists:estados_postulacion,id',
        ]);

        $estadoAnterior = $postulacion->estado_postulacion_id;
        $postulacion->estado_postulacion_id = $request->estado_postulacion_id;
        $postulacion->save();

        $estados = EstadoPostulacion::all()->keyBy('id');

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 5,
            'entidad_id' => $postulacion->id,
            'accion' => 'Cambio de estado de postulación',
            'valor_anterior' => ['estado' => $estados->get($estadoAnterior)?->nombre ?? $estadoAnterior],
            'valor_nuevo' => ['estado' => $estados->get($postulacion->estado_postulacion_id)?->nombre ?? $postulacion->estado_postulacion_id],
            'creado_en' => now(),
        ]);

        return back()->with('success', '¡Bien hecho! Actualizaste el estado de la postulación. :D');
    }

    public function citatorio($postulacion_id)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();
        $postulacion = Postulacion::with(['perfilEstudiante.usuario', 'ofertaPasantia.perfilEmpresa', 'ofertaPasantia.ubicacion'])
            ->where('id', $postulacion_id)
            ->whereHas('ofertaPasantia', function ($q) use ($empresa) {
                $q->where('perfil_empresa_id', $empresa->id);
            })
            ->firstOrFail();

        return view('paneles-control.citatorio', compact('postulacion', 'empresa'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DocumentoEstudiante;
use App\Models\Habilidad;
use App\Models\HabilidadEstudiante;
use App\Models\OfertaPasantia;
use App\Models\PerfilEstudiante;
use App\Models\Postulacion;
use App\Models\RegistroAuditoria;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function dashboard()
    {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::with(['usuario', 'documentos.tipoDocumento', 'habilidades.habilidad'])
            ->where('usuario_id', Auth::id())->firstOrFail();

        $postulaciones = Postulacion::with(['ofertaPasantia.perfilEmpresa', 'ofertaPasantia.ubicacion', 'estadoPostulacion'])
            ->where('perfil_estudiante_id', $estudiante->id)
            ->orderBy('id', 'desc')
            ->get();

        $total_postulaciones = $postulaciones->count();
        $en_entrevista = $postulaciones->filter(fn($p) => $p->estado_postulacion_id == 3)->count();
        $ofertas_disponibles = OfertaPasantia::with(['perfilEmpresa', 'ubicacion'])
            ->where('estado_publicacion_id', 2)
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();

        $tipos_documento = TipoDocumento::all();
        $habilidades_disponibles = Habilidad::all();

        return view('paneles-control.dashboard_student', compact(
            'estudiante', 'postulaciones', 'total_postulaciones',
            'en_entrevista', 'ofertas_disponibles',
            'tipos_documento', 'habilidades_disponibles'
        ));
    }

    public function actualizarPerfil(Request $request)
    {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->firstOrFail();

        $request->validate([
            'universidad' => 'required|string|max:200',
            'carrera' => 'required|string|max:200',
            'anio_graduacion' => 'nullable|integer|min:1900|max:2100',
            'biografia' => 'nullable|string|max:1000',
        ]);

        $estudiante->update($request->only(['universidad', 'carrera', 'anio_graduacion', 'biografia']));

        return back()->with('success', '¡Bien hecho! Actualizaste tus datos correctamente. :D');
    }

    public function subirDocumento(Request $request)
    {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->firstOrFail();

        $request->validate([
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
            'archivo' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $archivo = $request->file('archivo');
        $ruta = $archivo->store('documentos/' . $estudiante->id, 'public');

        DocumentoEstudiante::create([
            'perfil_estudiante_id' => $estudiante->id,
            'tipo_documento_id' => $request->tipo_documento_id,
            'nombre_original' => $archivo->getClientOriginalName(),
            'ruta_almacenamiento' => $ruta,
            'tipo_mime' => $archivo->getMimeType(),
            'tamano_bytes' => $archivo->getSize(),
        ]);

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 3,
            'entidad_id' => $estudiante->usuario_id,
            'accion' => 'Subida de documento',
            'valor_nuevo' => ['nombre_original' => $archivo->getClientOriginalName()],
            'creado_en' => now(),
        ]);

        return back()->with('success', '¡Bien hecho! Subiste tu documento correctamente. :D');
    }

    public function eliminarDocumento($id)
    {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->firstOrFail();
        $documento = DocumentoEstudiante::where('id', $id)
            ->where('perfil_estudiante_id', $estudiante->id)
            ->firstOrFail();

        Storage::disk('public')->delete($documento->ruta_almacenamiento);

        RegistroAuditoria::create([
            'usuario_id' => Auth::id(),
            'tipo_entidad_id' => 3,
            'entidad_id' => $estudiante->usuario_id,
            'accion' => 'Eliminación de documento',
            'valor_anterior' => ['nombre_original' => $documento->nombre_original],
            'creado_en' => now(),
        ]);

        $documento->delete();

        return back()->with('success', 'Documento eliminado correctamente.');
    }

    public function guardarHabilidad(Request $request)
    {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->firstOrFail();

        $request->validate([
            'habilidad_id' => 'required|exists:habilidades,id',
            'nivel' => 'required|integer|min:1|max:5',
        ]);

        $existe = HabilidadEstudiante::where('perfil_estudiante_id', $estudiante->id)
            ->where('habilidad_id', $request->habilidad_id)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ya tienes esta habilidad registrada.');
        }

        HabilidadEstudiante::create([
            'perfil_estudiante_id' => $estudiante->id,
            'habilidad_id' => $request->habilidad_id,
            'nivel' => $request->nivel,
        ]);

        return back()->with('success', '¡Bien hecho! Agregaste tu habilidad correctamente. :D');
    }

    public function eliminarHabilidad($id)
    {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->firstOrFail();
        $habilidad = HabilidadEstudiante::where('id', $id)
            ->where('perfil_estudiante_id', $estudiante->id)
            ->firstOrFail();

        $habilidad->delete();

        return back()->with('success', 'Habilidad eliminada correctamente.');
    }
}

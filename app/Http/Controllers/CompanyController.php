<?php

namespace App\Http\Controllers;

use App\Models\OfertaPasantia;
use App\Models\PerfilEmpresa;
use App\Models\Postulacion;
use App\Models\RegistroAuditoria;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function dashboard()
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::with('usuario')->where('usuario_id', Auth::id())->firstOrFail();
        $ofertas = OfertaPasantia::with(['ubicacion', 'estadoPublicacion'])
            ->where('perfil_empresa_id', $empresa->id)
            ->orderBy('id', 'desc')
            ->get();

        $total_postulantes = Postulacion::whereIn('oferta_pasantia_id', $ofertas->pluck('id'))->count();
        $postulaciones_recientes = Postulacion::with(['perfilEstudiante.usuario', 'ofertaPasantia', 'estadoPostulacion'])
            ->whereIn('oferta_pasantia_id', $ofertas->pluck('id'))
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('paneles-control.dashboard_company', compact('empresa', 'ofertas', 'total_postulantes', 'postulaciones_recientes'));
    }

    public function guardarOferta(Request $request)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        OfertaPasantia::create([
            'perfil_empresa_id' => $empresa->id,
            'ubicacion_id' => $request->ubicacion_id,
            'estado_publicacion_id' => 1,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        return redirect()->route('dashboard.company')->with('success', 'Oferta creada correctamente.');
    }

    public function actualizarOferta(Request $request, $id)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();
        $oferta = OfertaPasantia::where('id', $id)->where('perfil_empresa_id', $empresa->id)->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $oferta->update($request->only(['titulo', 'descripcion', 'ubicacion_id', 'fecha_inicio', 'fecha_fin']));

        return redirect()->route('dashboard.company')->with('success', 'Oferta actualizada correctamente.');
    }

    public function eliminarOferta($id)
    {
        abort_if(Auth::user()->rol_id != 2, 403);
        $empresa = PerfilEmpresa::where('usuario_id', Auth::id())->firstOrFail();
        $oferta = OfertaPasantia::where('id', $id)->where('perfil_empresa_id', $empresa->id)->firstOrFail();
        $oferta->delete();

        return redirect()->route('dashboard.company')->with('success', 'Oferta eliminada correctamente.');
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

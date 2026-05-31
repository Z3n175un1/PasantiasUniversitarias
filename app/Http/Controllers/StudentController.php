<?php

namespace App\Http\Controllers;

use App\Models\OfertaPasantia;
use App\Models\PerfilEstudiante;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        abort_if(Auth::user()->rol_id != 1, 403);
        $estudiante = PerfilEstudiante::where('usuario_id', Auth::id())->firstOrFail();

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

        return view('paneles-control.dashboard_student', compact(
            'estudiante', 'postulaciones', 'total_postulaciones',
            'en_entrevista', 'ofertas_disponibles'
        ));
    }
}

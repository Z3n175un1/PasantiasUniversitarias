<?php

namespace App\Http\Controllers;

use App\Models\DocumentoEstudiante;
use App\Models\PerfilEmpresa;
use App\Models\PerfilEstudiante;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
    public function ver($id)
    {
        $doc = DocumentoEstudiante::with('tipoDocumento', 'perfilEstudiante.usuario')->findOrFail($id);
        $user = Auth::user();

        if ($user->rol_id == 1) {
            $estudiante = PerfilEstudiante::where('usuario_id', $user->id)->firstOrFail();
            abort_if($doc->perfil_estudiante_id != $estudiante->id, 403);
        } elseif ($user->rol_id == 2) {
            $empresa = PerfilEmpresa::where('usuario_id', $user->id)->firstOrFail();
            $tieneAcceso = Postulacion::whereHas('ofertaPasantia', function ($q) use ($empresa) {
                $q->where('perfil_empresa_id', $empresa->id);
            })->where('perfil_estudiante_id', $doc->perfil_estudiante_id)->exists();
            abort_unless($tieneAcceso, 403);
        } elseif ($user->rol_id != 3) {
            abort(403);
        }

        return view('documentos.ver', compact('doc'));
    }
}

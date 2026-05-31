<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\PerfilEstudiante;
use App\Models\PerfilEmpresa;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('rol')->latest('creado_en')->paginate(20);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function show($id)
    {
        $usuario = Usuario::with(['rol', 'perfilEstudiante', 'perfilEmpresa'])->findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\PerfilEstudiante;
use App\Models\PerfilEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm($rol)
    {
        if (!in_array($rol, ['student', 'company'])) {
            abort(404);
        }

        return view('auth.register', compact('rol'));
    }

    public function register(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:usuarios,correo',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[0-9]/',
                'regex:/[A-Z]/',
                'regex:/[@$!%*?&]/'
            ],
            'role' => 'required|in:student,company',
        ];

        if ($request->role === 'student') {
            $rules = array_merge($rules, [
                'full_name' => 'required|string|max:255',
                'paternal_surname' => 'required|string|max:255',
                'maternal_surname' => 'required|string|max:255',
                'phone' => 'required|digits:8',
                'career' => 'required|string|max:255',
            ]);
        } else {
            $rules = array_merge($rules, [
                'company_name' => 'required|string|max:255',
                'sector' => 'required|string|max:255',
                'phone' => 'required|digits:8',
                'hr_name' => 'required|string|max:255',
                'hr_paternal' => 'required|string|max:255',
                'hr_maternal' => 'required|string|max:255',
            ]);
        }

        $validator = Validator::make($request->all(), $rules, [
            'email.unique' => 'Este correo ya está registrado.',
            'password.regex' => 'La contraseña debe tener al menos un número, una mayúscula y un carácter especial (@$!%*?&).',
            'phone.digits' => 'El celular debe tener exactamente 8 dígitos.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $rolId = $request->role === 'student' ? 1 : 2;

            if ($request->role === 'student') {
                $nombreCompleto = trim($request->full_name . ' ' . 
                                      $request->paternal_surname . ' ' . 
                                      $request->maternal_surname);
            } else {
                $nombreCompleto = trim($request->hr_name . ' ' . 
                                      $request->hr_paternal . ' ' . 
                                      $request->hr_maternal);
            }

            $usuario = Usuario::create([
                'rol_id' => $rolId,
                'nombre' => $nombreCompleto,
                'correo' => $request->email,
                'contrasena_hash' => Hash::make($request->password),
                'activo' => true,
            ]);

            if ($request->role === 'student') {
                PerfilEstudiante::create([
                    'usuario_id' => $usuario->id,
                    'universidad' => 'Por completar',
                    'carrera' => $request->career,
                    'anio_graduacion' => null,
                    'biografia' => null,
                ]);
            } else {
                PerfilEmpresa::create([
                    'usuario_id' => $usuario->id,
                    'nombre_empresa' => $request->company_name,
                    'industria' => $request->sector,
                    'sitio_web' => null,
                    'verificada' => false,
                ]);
            }

            DB::commit();

            auth()->login($usuario);

            if ($request->role === 'student') {
                return redirect()->route('dashboard.student')
                    ->with('success', '¡Bienvenido estudiante!');
            } else {
                return redirect()->route('dashboard.company')
                    ->with('success', '¡Bienvenida empresa!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear la cuenta.')->withInput();
        }
    }
}
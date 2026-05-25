<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa el login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingresa un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // Intentar autenticación con los campos de tu BD
        if (
            Auth::attempt([
                'correo' => $credentials['correo'],
                'password' => $credentials['password']
            ])
        ) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirigir según el rol (usando rol_id)
            if ($user->rol_id == 3) {
                return redirect()->intended(route('dashboard.admin'))
                    ->with('success', '¡Bienvenido Administrador!');
            }
            if ($user->rol_id == 2) {
                return redirect()->intended(route('dashboard.company'))
                    ->with('success', '¡Bienvenido! Has iniciado sesión correctamente.');
            }

            // rol_id = 1 (estudiante)
            return redirect()->intended(route('dashboard.student'))
                ->with('success', '¡Bienvenido! Has iniciado sesión correctamente.');
        }

        // Si falla la autenticación
        return back()
            ->withErrors([
                'correo' => 'Las credenciales no coinciden con nuestros registros.',
            ])
            ->withInput($request->only('correo'));
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Has cerrado sesión correctamente.');
    }
}
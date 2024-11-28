<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'tipo_usuario' => 'required|in:trabajador,empleador',
        ]);

        // Asignar el tipo de usuario automáticamente:
        // 1 = trabajador, 2 = empleador
        $tipoUsuarioId = $request->tipo_usuario == 'empleador' ? 2 : 1;

        // Crear el usuario con el tipo de usuario correspondiente
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario_id' => $tipoUsuarioId, // Asignar tipo de usuario basado en el valor recibido
        ]);

        // Redirigir al formulario de login con un mensaje de éxito
        return redirect()->route('login')->with('message', 'Registro exitoso. Inicia sesión para continuar.');
    }
}

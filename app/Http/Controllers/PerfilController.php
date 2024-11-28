<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function editar()
    {
        // Obtener el trabajador asociado al usuario autenticado
        $trabajador = Auth::user()->trabajador;

        // Mostrar el formulario de edición del perfil
        return view('perfil.editar', compact('trabajador'));
    }

    public function actualizar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'telefono' => 'required',
            'direccion' => 'required',
            'trabajo' => 'required',
        ]);

        // Obtener el trabajador autenticado
        $trabajador = Auth::user()->trabajador;

        // Actualizar el perfil del trabajador
        $trabajador->update([
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'trabajo' => $request->trabajo,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('dashboard.trabajador')->with('success', 'Perfil actualizado con éxito.');
    }
}

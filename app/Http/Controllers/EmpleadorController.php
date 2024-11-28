<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Trabajador;
use App\Models\Empleador;
use App\Models\Publicacion;
use App\Models\Opinion;
use Illuminate\Http\Request;

class EmpleadorController extends Controller
{

    public function subirAntecedentes(Request $request, $id)
    {
        $request->validate([
            'antecedentes' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        $empleador = Empleador::findOrFail($id);

        // Subir el archivo
        if ($request->hasFile('antecedentes')) {
            // Borrar archivo antiguo si existe
            if ($empleador->antecedentes) {
                Storage::delete($empleador->antecedentes);
            }

            // Guardar el nuevo archivo
            $filePath = $request->file('antecedentes')->store('antecedentes', 'public');
            

            // Actualizar el campo en la base de datos
            $empleador->antecedentes = $filePath;
            $empleador->save();
        }

        return redirect()->back()->with('success', 'Antecedentes actualizados correctamente.');
    }


    public function subirFotoPerfil(Request $request, $id)
    {
        $request->validate([
            'foto_perfil' => 'required|image|max:2048',
        ]);

        $empleador = Empleador::findOrFail($id);

        // Eliminar la foto anterior si existe
        if ($empleador->foto_perfil) {
            Storage::delete('public/' . $empleador->foto_perfil);
        }

        // Guardar la nueva foto
        $path = $request->file('foto_perfil')->store('fotos_perfil_empleador', 'public');

        // Guardar solo el nombre del archivo, no la ruta completa
        $empleador->foto_perfil = basename($path);
        $empleador->save();

        return redirect()->back()->with('success', 'Foto de perfil actualizada correctamente.');
    }

    public function buscarTrabajo(Request $request)
    {
        // Verificar si el usuario es un empleador
        if (Auth::user()->tipo !== 'empleador') {
            return redirect()->route('dashboard.empleador')->with('error', 'Acción no permitida.');
        }

        // Lógica para buscar trabajos
        $trabajos = Trabajo::where('titulo', 'like', '%' . $request->query('busqueda') . '%')->get();

        return view('empleador.buscar-trabajo', compact('trabajos'));
    }

    public function verPerfil($id)
    {
        // Buscar el empleador por ID
        $empleador = Empleador::findOrFail($id);
        
        // Recuperar las publicaciones del empleador
        $publicaciones = $empleador->publicaciones;
        
        // Recuperar otras informaciones que quieras mostrar
        return view('empleador.perfil', [
            'empleador' => $empleador,
            'publicaciones' => $publicaciones
        ]);
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Trabajador;
use App\Models\Empleador;
use App\Models\Publicacion;
use App\Models\Opinion;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function subirArchivo(Request $request, $id)
    {
        $request->validate([
            'antecedentes' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        $trabajador = Trabajador::findOrFail($id);

        // Subir el archivo
        if ($request->hasFile('antecedentes')) {
            // Borrar archivo antiguo si existe
            if ($trabajador->antecedentes) {
                Storage::delete($trabajador->antecedentes);
            }

            // Guardar el nuevo archivo
            $filePath = $request->file('antecedentes')->store('antecedentes', 'public');

            // Actualizar el campo en la base de datos
            $trabajador->antecedentes = $filePath;
            $trabajador->save();
        }

        return redirect()->back()->with('success', 'Antecedentes actualizados correctamente.');
    }

    public function buscarEmpleador(Request $request)
    {
        $buscarNombre = $request->input('buscar_nombre');
        $buscarTrabajo = $request->input('buscar_trabajo');

        // Realiza la búsqueda combinada
        $empleadores = Empleador::whereHas('user', function ($query) use ($buscarNombre) {
            $query->where('name', 'like', '%' . $buscarNombre . '%');
        })
        ->whereHas('publicaciones', function ($query) use ($buscarTrabajo) {
            $query->where('descripcion', 'like', '%' . $buscarTrabajo . '%');
        })
        ->get();

        return view('dashboard.trabajador', compact('empleadores'));
    }

    public function subirFotoPerfil(Request $request, $id)
    {
        $request->validate([
            'foto_perfil' => 'required|image|max:2048',
        ]);

        $trabajador = Trabajador::findOrFail($id);

        // Eliminar la foto anterior si existe
        if ($trabajador->foto_perfil) {
            Storage::delete('public/' . $trabajador->foto_perfil);
        }

        // Guardar la nueva foto
        $path = $request->file('foto_perfil')->store('fotos_perfil', 'public');

        // Guardar solo el nombre del archivo, no la ruta completa
        $trabajador->foto_perfil = basename($path);
        $trabajador->save();

        return redirect()->back()->with('success', 'Foto de perfil actualizada correctamente.');
    }

}

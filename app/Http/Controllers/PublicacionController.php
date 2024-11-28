<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('oficio');

        $publicaciones = Publicacion::with('empleador')
            ->where('descripcion', 'like', "%$query%")
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        // Devolver una vista parcial con los resultados, que se cargará en el modal
        return view('publicaciones.resultados', compact('publicaciones'));
    }
     
    public function mostrar()
    {
        // Obtener las publicaciones ordenadas por fecha de publicación, de más reciente a más antiguo
        $publicaciones = Publicacion::orderBy('fecha_publicacion', 'desc')->get();

        return view('publicaciones.mostrar', compact('publicaciones'));
    }
    
   
    public function create()
    {
        return view('publicaciones.create');
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'descripcion' => 'required|string|max:1000',
            'estado' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
        ]);

        // Obtener el empleador autenticado
        $empleador = auth()->user()->empleador;

        // Crear la nueva publicación
        $publicacion = Publicacion::create([
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'direccion' => $request->direccion,
            'fecha_publicacion' => now(), // Fecha actual
            'empleador_id' => $empleador->id,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('dashboard.empleador')
            ->with('success', 'Publicación creada exitosamente');
    }


}

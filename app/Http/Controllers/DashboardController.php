<?php
namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\Empleador;
use App\Models\Publicacion;
use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Mostrar el dashboard del trabajador.
     */

    public function trabajador()
    {
        // Obtener todas las publicaciones creadas por los empleadores
        $publicaciones = Publicacion::orderBy('created_at', 'desc')->get()->unique('id');

        // Obtener las opiniones del trabajador actual
        $opiniones = Opinion::where('trabajador_id', Auth::user()->trabajador->id)->get();

        // Obtener la información del trabajador
        $trabajador = Auth::user()->trabajador;

        // Pasar las variables a la vista
        return view('dashboard.trabajador', compact('publicaciones', 'opiniones', 'trabajador'));
    }

    public function empleador()
    {
        // Obtener el empleador que está logueado
        $empleador = Empleador::where('user_id', Auth::id())->first();
    
        // Obtener las publicaciones del empleador que está logueado
        $misPublicaciones = Publicacion::where('empleador_id', $empleador->id)->get();
    
        // Obtener las publicaciones de otros empleadores más recientes
        $publicacionesOtras = Publicacion::where('empleador_id', '!=', $empleador->id)
        ->orderBy('created_at', 'desc')  // Otra forma de ordenar descendentemente
        ->groupBy('id')  // Prevenir duplicados
        ->get();

        // Pasar el empleador, sus publicaciones y las publicaciones de otros empleadores a la vista
        return view('dashboard.empleador', compact('empleador', 'misPublicaciones', 'publicacionesOtras'));
    }
}


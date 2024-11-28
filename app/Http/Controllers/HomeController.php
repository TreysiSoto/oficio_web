<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener las publicaciones ordenadas por fecha
        $publicaciones = Publicacion::orderBy('fecha_publicacion', 'desc')->get();
        return view('welcome', compact('publicaciones'));
    }
}

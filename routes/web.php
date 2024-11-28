<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación y perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard: redirige a dashboard según tipo de usuario
    Route::get('/dashboard', function () {
        return Auth::user()->tipo_usuario == 'trabajador'
            ? redirect()->route('dashboard.trabajador')
            : redirect()->route('dashboard.empleador');
    })->name('dashboard');

    // Rutas para los dashboards de trabajador y empleador
    Route::get('/dashboard/trabajador', [DashboardController::class, 'trabajador'])->name('dashboard.trabajador');
    Route::get('/dashboard/empleador', [DashboardController::class, 'empleador'])->name('dashboard.empleador');

    // Rutas de perfil del trabajador
    Route::get('/perfil/editar', [PerfilController::class, 'editar'])->name('perfil.editar_trabajador');
    Route::post('/perfil/editar', [PerfilController::class, 'actualizar'])->name('perfil.actualizar_trabajador');

    // Rutas para las publicaciones
    Route::resource('publicaciones', PublicacionController::class);

    Route::post('/empleador/{id}/subir-foto-perfil', [EmpleadorController::class, 'subirFotoPerfil'])->name('empleador.subirFotoPerfil');
    Route::post('/trabajadores/{id}/subir-foto-perfil', [TrabajadorController::class, 'subirFotoPerfil'])->name('trabajador.subirFotoPerfil');

    // Rutas de búsqueda para trabajadores y empleadores
    Route::get('/empleador/buscar-trabajo', [EmpleadorController::class, 'buscarTrabajo'])->name('empleador.buscarTrabajo');
    Route::get('/trabajadores/buscar-empleador', [TrabajadorController::class, 'buscarEmpleador'])->name('trabajador.buscarEmpleador');
    
    // Ruta corregida para acceder a fotos de perfil (asegúrate de haber creado el enlace simbólico)
    Route::get('/storage/fotos_perfil_empleador/{filename}', function ($filename) {
        $path = storage_path('app/public/fotos_perfil_empleador/' . $filename);

        if (file_exists($path)) {
            return response()->file($path);
        }

        abort(404);
    });

    Route::get('/storage/fotos_perfil/{filename}', function ($filename) {
        $path = storage_path('app/public/fotos_perfil/' . $filename);

        if (file_exists($path)) {
            return response()->file($path);
        }

        abort(404);
    });   

    
    Route::post('/empleadores/{id}/antecedentes', [EmpleadorController::class, 'subirAntecedentes'])
    ->name('empleador.subirAntecedentes');

    Route::post('/trabajadores/{id}/antecedentes', [TrabajadorController::class, 'subirArchivo'])
    ->name('trabajador.subirArchivo');

    
    Route::get('/storage/antecedentes/{filename}', function ($filename) {
        $path = storage_path('app/public/antecedentes/' . $filename);
    
        if (file_exists($path)) {
            return response()->file($path);
        }
    
        abort(404);
    })->name('view.antecedentes');

    Route::get('/empleador/{id}/perfil', [EmpleadorController::class, 'verPerfil'])
    ->name('empleador.perfil');
        

});

    
// Rutas de búsqueda de publicaciones
Route::get('/buscar', [PublicacionController::class, 'buscar'])->name('buscar');

Route::get('/mostrar', [PublicacionController::class, 'mostrar'])->name('mostrar');

// Rutas para publicaciones
Route::get('/publicacion/create', [PublicacionController::class, 'create'])->name('publicacion.create');
Route::post('/publicacion/store', [PublicacionController::class, 'store'])->name('publicacion.store');

Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';

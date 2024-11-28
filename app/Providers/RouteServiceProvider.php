<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    
    public function boot(): void
    {
        $this->routes(function () {
            // Cargar rutas para API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Cargar rutas generales
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Cargar rutas de autenticación
            Route::middleware('auth')
                ->group(base_path('routes/auth.php'));  // Esta es la línea que debes agregar
        });
    }
}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Oficio Web</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen flex flex-col bg-[#FFFFFF] text-white relative">
    <!-- Navbar -->
    <nav class="bg-[#77ACA2] shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <div class="flex justify-center py-4">
                    <x-application-logo />
                    </div>

                    <h1 class="text-3xl font-bold text-[#031926]">Oficio Web</h1>
                </div>

                <!-- Navigation -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    @if (Auth::check())
                        <!-- Si el usuario está autenticado, redirigir al dashboard adecuado -->
                        @if (Auth::user()->tipo_usuario_id == DB::table('tipo_usuarios')->where('nombre', 'trabajador')->value('id'))
                            <a href="{{ route('dashboard.trabajador') }}" 
                            class="text-[#afcdea] hover:bg-[#afcdea]/20 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                Panel Trabajador
                            </a>
                        @elseif (Auth::user()->tipo_usuario_id == DB::table('tipo_usuarios')->where('nombre', 'empleador')->value('id'))
                            <a href="{{ route('dashboard.empleador') }}" 
                            class="text-[#afcdea] hover:bg-[#afcdea]/20 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                Panel Empleador
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                        class="bg-[#031926] text-white hover:bg-[#318ce7] px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" 
                        class="bg-[#031926] text-white hover:bg-[#318ce7] px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out shadow-md hover:shadow-lg">
                            Registrarse
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </nav>

    <!-- Descripción de la Plataforma -->
    <section class="bg-[#FFFFFF]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-3 text-center">
            <h2 class="text-3xl font-extrabold text-[#000000]">¡Bienvenido!</h2>
            <p class="mt-4 text-lg text-[#000000]">Conectamos trabajadores de oficios con empleadores en la ciudad de Huánuco. Encuentra oportunidades laborales o el trabajador ideal para tus proyectos.</p>
        </div>
    </section>

    <!-- Formulario de búsqueda -->
    <section class="bg-[#FFFFFF] py-4">
        <div class="max-w-md mx-auto px-4 sm:px-4 lg:px-4 mt-8">
            <form id="searchForm" class="space-y-4">
                <div class="flex items-center space-x-2">
                    <input 
                        type="text" 
                        name="oficio" 
                        id="oficioInput"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#318ce7]" 
                        placeholder="Buscar oficio (Ej. Albañil, Carpintero)" 
                        required
                    >
                    <button 
                        type="submit" 
                        class="bg-[#031926] text-white border border-[#318ce7] px-4 py-2 rounded-md hover:bg-[#064d7c]">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </section>


<!-- Modal -->
<div class="modal fade" id="searchResultsModal" tabindex="-1" aria-labelledby="searchResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchResultsModalLabel">Resultados de la búsqueda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Resultados dinámicos se cargarán aquí -->
                <div id="modalContent">
                    <!-- Se mostrará después de cargar con AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>

    
    <section class="relative bg-cover bg-center py-12" style="background-image: url('{{ asset('img/fondo.png') }}');">
    <div class="absolute"></div> <!-- Oscurece un poco el fondo -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-black mb-6">Publicaciones Recientes</h2>
        <p class="text-lg text-black mb-8">Descubre las mejores oportunidades publicadas por empleadores o trabajadores.</p>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- Columna izquierda: Lo que se ofrece -->
            <div class="hidden lg:block text-white space-y-6">
                <div class="p-6 bg-[#031926] rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">¿Qué encontrarás aquí?</h3>
                    <ul class="mt-4 space-y-2 text-gray-300">
                        <li>- Oportunidades laborales.</li>
                        <li>- Servicios ofrecidos por trabajadores.</li>
                        <li>- Conexiones confiables y seguras.</li>
                    </ul>
                </div>
                <div class="p-6 bg-[#031926] rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">Ventajas de usar nuestra plataforma</h3>
                    <ul class="mt-4 space-y-2 text-gray-300">
                        <li>- Fácil de usar y accesible.</li>
                        <li>- Calificaciones que generan confianza.</li>
                        <li>- Publicaciones personalizables.</li>
                    </ul>
                </div>
            </div>

            <!-- Columna central: Publicaciones -->
            <div class="flex flex-col items-center space-y-6">
                @foreach ($publicaciones as $publicacion)
                    <div class="w-full max-w-md bg-[#507dbc] p-6 rounded-lg shadow-md relative">
                        <!-- Icono en la parte superior -->
                        <div class="absolute top-[-30px] left-1/2 transform -translate-x-1/2">
                            <img src="{{ asset('img/icono.png') }}" alt="Icono" class="w-16 h-16">
                        </div>

                        <!-- Contenedor de texto -->
                        <div class="mt-8 text-left">
                            <!-- Descripción -->
                            <p class="mt-1 text-black font-bold text-base">{{ $publicacion->descripcion }}</p>

                            <!-- Dirección 
                            <p class="mt-1 text-gray-200 text-base">Direccion: {{ $publicacion->  direccion }}</p>-->
                            <p class="mt-1 text-gray-100 text-base">Estado: {{ $publicacion->  estado }}
                             <!-- Fecha de publicación -->
                             <p class="mt-2 text-gray-200 text-base">
                                Publicado el: 
                                <span class="font-bold">
                                    {{ \Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y') }}
                                </span>
                            </p>
                        </div>

                        <!-- Botón Ver más -->
                        <div class="mt-6 text-center">
                            <a href="{{ route('register') }}" 
                            class="inline-block bg-[#77ACA2] text-[#031926] py-2 px-4 rounded-md font-medium hover:bg-[#468189] transition duration-150 ease-in-out">
                            Ver más
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Columna derecha: Contenido adicional -->
            <div class="hidden lg:block text-white space-y-6">
                <div class="p-6 bg-[#031926] rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">Publicaciones destacadas</h3>
                    <ul class="mt-4 space-y-2 text-white">
                        <li>- Electricista </li>
                        <li>- Albañil con experiencia.</li>
                        <li>- Carpintero </li>
                    </ul>
                </div>
                <div class="p-6 bg-[#031926] rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">¿Cómo empezar?</h3>
                    <ol class="mt-4 space-y-2 text-white">
                        <li>1. Regístrate como trabajador o empleador.</li>
                        <li>2. Publica o busca servicios.</li>
                        <li>3. Conecta y realiza acuerdos.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Footer -->
    <footer class="bg-[#77ACA2] mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-black text-sm">
                © {{ date('Y') }} Oficio Web. Todos los derechos reservados.
            </p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        // Evitar el envío tradicional del formulario
        $('#searchForm').on('submit', function (e) {
            e.preventDefault(); // Prevenir el comportamiento normal del formulario

            // Obtener el valor del input
            let query = $('#oficioInput').val();

            // Realizar la petición AJAX
            $.ajax({
                url: "{{ route('buscar') }}", // Ruta al controlador Laravel
                method: "GET", // Método GET
                data: { oficio: query }, // Los datos de búsqueda
                success: function (response) {
                    // Insertar los resultados en el modal
                    $('#modalContent').html(response);

                    // Mostrar el modal
                    $('#searchResultsModal').modal('show');
                },
                error: function () {
                    $('#modalContent').html('<p class="text-danger">Ocurrió un error al buscar los resultados.</p>');
                    $('#searchResultsModal').modal('show');
                }
            });
        });
    });
</script>

<!-- JS de Bootstrap (al final del body para cargar después del contenido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



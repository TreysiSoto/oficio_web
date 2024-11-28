<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Oficio Web</title>

    <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php endif; ?>
</head>
<body class="min-h-screen flex flex-col bg-[#FFFFFF] text-white relative">
    <!-- Navbar -->
    <nav class="bg-[#77ACA2] shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <div class="flex justify-center py-4">
                    <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                    </div>

                    <h1 class="text-3xl font-bold text-[#031926]">Oficio Web</h1>
                </div>

                <!-- Navigation -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <?php if(Auth::check()): ?>
                        <!-- Si el usuario está autenticado, redirigir al dashboard adecuado -->
                        <?php if(Auth::user()->tipo_usuario_id == DB::table('tipo_usuarios')->where('nombre', 'trabajador')->value('id')): ?>
                            <a href="<?php echo e(route('dashboard.trabajador')); ?>" 
                            class="text-[#afcdea] hover:bg-[#afcdea]/20 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                Panel Trabajador
                            </a>
                        <?php elseif(Auth::user()->tipo_usuario_id == DB::table('tipo_usuarios')->where('nombre', 'empleador')->value('id')): ?>
                            <a href="<?php echo e(route('dashboard.empleador')); ?>" 
                            class="text-[#afcdea] hover:bg-[#afcdea]/20 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                Panel Empleador
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" 
                        class="bg-[#031926] text-white hover:bg-[#318ce7] px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Iniciar Sesión
                        </a>
                        <a href="<?php echo e(route('register')); ?>" 
                        class="bg-[#031926] text-white hover:bg-[#318ce7] px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out shadow-md hover:shadow-lg">
                            Registrarse
                        </a>
                    <?php endif; ?>
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

    
    <section class="relative bg-cover bg-center py-12" style="background-image: url('<?php echo e(asset('img/fondo.png')); ?>');">
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
                <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="w-full max-w-md bg-[#507dbc] p-6 rounded-lg shadow-md relative">
                        <!-- Icono en la parte superior -->
                        <div class="absolute top-[-30px] left-1/2 transform -translate-x-1/2">
                            <img src="<?php echo e(asset('img/icono.png')); ?>" alt="Icono" class="w-16 h-16">
                        </div>

                        <!-- Contenedor de texto -->
                        <div class="mt-8 text-left">
                            <!-- Título de la publicación -->
                            <h3 class="text-lg font-semibold text-white"><?php echo e($publicacion->titulo); ?></h3>

                            <!-- Descripción -->
                            <p class="mt-1 text-gray-200 text-base"><?php echo e($publicacion->descripcion); ?></p>

                            <!-- Dirección -->
                            <p class="mt-1 text-gray-200 text-base">Direccion: <?php echo e($publicacion->  direccion); ?></p>

                             <!-- Fecha de publicación -->
                             <p class="mt-2 text-gray-200 text-base">
                                Publicado el: 
                                <span class="font-bold">
                                    <?php echo e(\Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y')); ?>

                                </span>
                            </p>
                        </div>

                        <!-- Botón Ver más -->
                        <div class="mt-6 text-center">
                            <a href="<?php echo e(route('login')); ?>" 
                            class="inline-block bg-[#77ACA2] text-[#031926] py-2 px-4 rounded-md font-medium hover:bg-[#468189] transition duration-150 ease-in-out">
                            Ver más
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                © <?php echo e(date('Y')); ?> Oficio Web. Todos los derechos reservados.
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
                url: "<?php echo e(route('buscar')); ?>", // Ruta al controlador Laravel
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


<?php /**PATH C:\laragon\www\app-oficioweb\resources\views/welcome.blade.php ENDPATH**/ ?>
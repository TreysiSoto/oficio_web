<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <style>
            .map {
                height: 300px;
                width: 100%;
                margin-top: 10px;
            }
        </style>
    </head>
    
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Columna 1: Información del Perfil del Trabajador -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md h-auto overflow-auto">
                    <!-- Foto de Perfil -->
                    <div class="flex flex-col items-center mb-6">
                        <?php if($trabajador->foto_perfil): ?>
                            <div class="relative mb-4">
                                <img src="<?php echo e(asset('storage/fotos_perfil/' . $trabajador->foto_perfil)); ?>" 
                                     alt="Foto de Perfil" 
                                     class="rounded-full w-32 h-32 border-4 border-Silver shadow-lg">
                            </div>
                        <?php else: ?>
                            <p class="text-gray-600 mb-4">No has subido una foto de perfil.</p>
                        <?php endif; ?>
                        <form action="<?php echo e(route('trabajador.subirFotoPerfil', $trabajador->id)); ?>" 
                              method="POST" 
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <label for="foto_perfil" class="px-4 py-2 bg-[#031926] text-white rounded-lg cursor-pointer hover:bg-blue-700">
                                Subir Foto
                            </label>
                            <input type="file" 
                                   name="foto_perfil" 
                                   id="foto_perfil" 
                                   accept="image/*" 
                                   class="hidden" 
                                   onchange="this.form.submit()">
                        </form>
                    </div>
                    
                    <!-- Información General -->
                    <?php if(Auth::check()): ?>
                        <p><strong>Nombre:</strong> <?php echo e(Auth::user()->name); ?></p>
                    <?php endif; ?>
                    <?php if($trabajador->dni): ?>
                        <p><strong>DNI:</strong> <?php echo e($trabajador->dni); ?></p>
                    <?php endif; ?>
                    <?php if($trabajador->telefono): ?>
                        <p><strong>Teléfono:</strong> <?php echo e($trabajador->telefono); ?></p>
                    <?php endif; ?>
                    <?php if($trabajador->direccion): ?>
                        <p><strong>Dirección:</strong> <?php echo e($trabajador->direccion); ?></p>
                    <?php endif; ?>
                    <?php if($trabajador->antecedentes): ?>
                        <p class="mb-4">
                            <strong>Antecedentes:</strong> 
                            <a href="<?php echo e(Storage::url($trabajador->antecedentes)); ?>" target="_blank" class="text-blue-500 hover:text-blue-700">
                                Ver archivo
                            </a>
                        </p>
                    <?php else: ?>
                        <p class="mb-4"><strong>Antecedentes:</strong> No especificados</p>
                    <?php endif; ?>

                    <!-- Botón para subir antecedentes -->
                    <form action="<?php echo e(route('trabajador.subirArchivo', $trabajador->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <label for="antecedentes" class="px-4 py-2 bg-[#031926] text-white rounded-lg cursor-pointer hover:bg-blue-700">
                            Subir Antecedentes
                        </label>
                        <input 
                            type="file" 
                            name="antecedentes" 
                            id="antecedentes" 
                            accept="application/pdf, image/*" 
                            class="hidden" 
                            onchange="this.form.submit()"
                        >
                    </form>
                
                    <!-- Opiniones del Trabajador -->
                    <div class="mt-6">
                       <!--  <h3 class="text-lg font-semibold">Calificaciones y Comentarios</h3> -->
                        <?php if($opiniones->isEmpty()): ?>
                            <p>No tienes calificaciones aún.</p>
                        <?php else: ?>
                            <ul class="space-y-4">
                                <?php $__currentLoopData = $opiniones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opinion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="p-4 bg-gray-100 border border-gray-300 rounded-lg">
                                        <p><strong></strong> <?php echo e($opinion->empleador->user->name); ?></p>
                                        
                                        <!-- Mostrar calificación con estrellas -->
                                        <p class="flex items-center">
                                            <strong>Calificación:</strong>
                                            <span class="ml-2">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <?php if($i <= $opinion->calificacion): ?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 inline" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.482 4.564a1 1 0 00.95.69h4.8c.969 0 1.371 1.24.588 1.81l-3.89 2.829a1 1 0 00-.364 1.118l1.482 4.564c.3.921-.755 1.688-1.54 1.118l-3.89-2.828a1 1 0 00-1.176 0l-3.89 2.828c-.785.57-1.84-.197-1.54-1.118l1.482-4.564a1 1 0 00-.364-1.118L2.18 9.99c-.783-.57-.38-1.81.588-1.81h4.8a1 1 0 00.95-.69L9.049 2.927z"/>
                                                        </svg>
                                                    <?php else: ?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300 inline" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.482 4.564a1 1 0 00.95.69h4.8c.969 0 1.371 1.24.588 1.81l-3.89 2.829a1 1 0 00-.364 1.118l1.482 4.564c.3.921-.755 1.688-1.54 1.118l-3.89-2.828a1 1 0 00-1.176 0l-3.89 2.828c-.785.57-1.84-.197-1.54-1.118l1.482-4.564a1 1 0 00-.364-1.118L2.18 9.99c-.783-.57-.38-1.81.588-1.81h4.8a1 1 0 00.95-.69L9.049 2.927z"/>
                                                        </svg>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </span>
                                        </p>

                                        <p class="mt-2"><?php echo e($opinion->mensaje); ?></p>
                                        <p class="text-sm text-gray-500">Publicado el: <?php echo e(\Carbon\Carbon::parse($opinion->fecha)->format('d/m/Y')); ?></p>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- Columna 2 y 3: Publicaciones de Empleadores -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- Encabezado con barra de búsqueda -->
                    <div class="flex justify-center items-center">
                        <div class="p-4 rounded-md shadow-sm">
                            <form action="<?php echo e(route('trabajador.buscarEmpleador')); ?>" method="GET">
                                <div class="flex space-x-1">
                                    <input 
                                        type="text" 
                                        name="buscar_trabajo" 
                                        id="buscar_trabajo" 
                                        class="p-3 border rounded-md w-3/4 text-xs" 
                                    >
                                    <button type="submit" class="px-2 py-1 bg-[#031926] text-white rounded-md hover:bg-blue-700 text-xs">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php if($publicaciones->isNotEmpty()): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="p-6 border rounded-lg bg-white shadow-md hover:shadow-lg transition-shadow duration-300">
                                    <p class="text-gray-800 font-semibold text-lg"><?php echo e($publicacion->empleador->user->name); ?>

                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['class' => 'ms-4 bg-[#9DBEBB]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ms-4 bg-[#9DBEBB]']); ?>
                                         <?php echo e(__('Ver perfil')); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                    
                                    <p class="text-gray-800 text-lg"><?php echo e($publicacion->descripcion); ?></p>
                                    
                                    <!-- Dirección con estilo -->
                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Ubicado en </span>
                                        <a href="https://www.google.com/maps?q=<?php echo e(urlencode($publicacion->direccion)); ?>" 
                                        target="_blank" 
                                        class="text-indigo-600 font-semibold hover:text-indigo-800 transition-colors duration-200">
                                            <?php echo e($publicacion->direccion); ?>

                                        </a>
                                    </p>

                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Empleo:</span>
                                        <?php echo e($publicacion->estado); ?>

                                    </p>

                                    <p class="text-gray-600 mt-2 text-sm">
                                        <span class="font-medium text-gray-500">Fecha de publicación:</span> 
                                        <?php echo e(\Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y')); ?>

                                    </p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600 text-lg">No hay publicaciones disponibles de empleadores. ¡Mantente atento a las nuevas ofertas!</p>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\app-oficioweb\resources\views\dashboard\trabajador.blade.php ENDPATH**/ ?>
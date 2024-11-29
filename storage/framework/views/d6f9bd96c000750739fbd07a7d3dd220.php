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
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
                
            </script>
            
            <style>
                .map {
                    height: 300px;
                    width: 100%;
                    margin-top: 10px;
                }
            </style>
    </head>
        

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-7">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Columna Izquierda: Foto e Información del Perfil -->
                    <div class="lg:col-span-1 space-y-8">
                        <div class="flex flex-col items-center bg-gray-50 p-6 rounded-lg shadow-md">
                        
                        <?php if($empleador->foto_perfil): ?>
                            <div class="relative mb-4">
                            <img src="<?php echo e(asset('storage/fotos_perfil_empleador/' . $empleador->foto_perfil)); ?>" 
                                     alt="Foto de Perfil" 
                                     class="rounded-full w-32 h-32 border-4 border-Silver shadow-lg">
                            </div>
                        <?php else: ?>
                            <p class="text-gray-600 mb-4">No has subido una foto de perfil.</p>
                        <?php endif; ?>

                        <!-- Botón para subir foto -->
                        <form action="<?php echo e(route('empleador.subirFotoPerfil', $empleador->id)); ?>" method="POST" enctype="multipart/form-data" class="mb-4">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('POST'); ?>

                            <!-- Botón de carga de archivo oculto y asociado al botón visible -->
                            <label for="foto_perfil" class="px-4 py-2 bg-[#031926] text-white rounded-lg cursor-pointer hover:bg-[#468189]">
                                Subir Foto
                            </label>
                            <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" class="hidden" onchange="this.form.submit()">
                        </form>
                        
                        <!-- Sección Información del Perfil -->
                        <!--<h3 class="text-xl font-semibold mb-4">Información del Perfil</h3>-->
                        <div class="space-y-4">
                            <?php if(Auth::check()): ?>
                                <p><strong></strong> <?php echo e(Auth::user()->name); ?></p>
                            <?php endif; ?>
                            <?php if($empleador->nombre_empresa): ?>
                                <p><strong></strong> <?php echo e($empleador->nombre_empresa); ?></p>
                            <?php endif; ?>
                            <?php if($empleador->dni): ?>
                                <p><strong>DNI:</strong> <?php echo e($empleador->dni); ?></p>
                            <?php endif; ?>
                            <?php if($empleador->telefono): ?>
                                <p><strong>Teléfono:</strong> <?php echo e($empleador->telefono); ?></p>
                            <?php endif; ?>
                            <?php if($empleador->direccion): ?>
                                <p><strong>Dirección:</strong> <?php echo e($empleador->direccion); ?></p>
                            <?php endif; ?>

                            <?php if($empleador->antecedentes): ?>
                        <p class="mb-4">
                            <strong>Antecedentes:</strong> 
                            <a href="<?php echo e(Storage::url($empleador->antecedentes)); ?>" target="_blank" class="text-blue-500">
                                Ver archivo
                            </a>
                        </p>
                        <?php else: ?>
                            <p class="mb-4"><strong>Antecedentes:</strong> No especificados</p>
                        <?php endif; ?>

                              <!-- Botón para subir antecedentes -->
                            <form action="<?php echo e(route('empleador.subirAntecedentes', $empleador->id)); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <label for="antecedentes" class="px-4 py-2 bg-[#031926] text-white rounded-lg cursor-pointer hover:bg-[#468189]">
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
                            <div class="block justify-end mb-4">
                                <a href="<?php echo e(route('publicacion.create')); ?>" class="bg-[#031926] text-white px-4 py-2 rounded-lg hover:bg-[#468189] transition">
                                Crear Nueva Publicación
                                </a>
                            </div>
                            <button id="openModal" class="bg-[#031926] text-white py-2 px-4 rounded hover:bg-[#468189]">
                                Ver Mis Publicaciones
                            </button>
                        </div>
                        
                    </div>
                                         
                     <!-- Modal para ver las publicaciones del empleador -->
    
                     <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                            <div class="bg-white rounded-lg shadow-xl w-3/4 max-w-3xl p-6 relative">
                                <h2 class="text-xl font-semibold mb-4">Mis Publicaciones de Trabajo</h2>
                                
                                <?php if($misPublicaciones->isNotEmpty()): ?>
                                    <div class="space-y-6">
                                        <?php $__currentLoopData = $misPublicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="p-4 border rounded-lg bg-gray-50">
                                                <p class="text-gray-600"><?php echo e(\Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y')); ?></p>
                                                <p class="text-gray-600 mt-2"><?php echo e($publicacion->descripcion); ?></p>
                                                <p class="text-sm text-gray-500">Estado: <span class="font-semibold"><?php echo e($publicacion->estado); ?></span></p>
                                                <div class="mt-4 flex space-x-4">
                                                    <button class="text-blue-500 hover:text-blue-700">Editar</button>
                                                    <button class="text-red-500 hover:text-red-700">Eliminar</button>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <p>No hay publicaciones disponibles. ¡Crea una nueva oferta de trabajo!</p>
                                <?php endif; ?>

                                <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
                            </div>
                        </div>
                    </div>
                    
                <!-- Columna Derecha: Secciones Adicionales -->
                <div class="lg:col-span-2 space-y-4">
                <!-- Sección de Buscar Trabajo -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <form action="<?php echo e(route('empleador.buscarTrabajo')); ?>" method="GET">
                        <div class="flex space-x-2">
                            <input type="text" name="buscar_trabajo" id="buscar_trabajo" class="p-2 border rounded-lg w-full text-sm" placeholder="Ejemplo: Albañil, Electricista, etc.">
                            <button type="submit" class="px-4 py-2 bg-[#031926] text-white rounded-lg hover:bg-[#468189] text-sm">Buscar</button>
                        </div>
                    </form>
                </div>

                <!-- Sección de Publicaciones de Empleadores -->
                <div class="space-y-6">
                    <?php if($publicacionesOtras->isNotEmpty()): ?>
                        <?php $__currentLoopData = $publicacionesOtras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 border rounded-lg bg-gray-50">
                                <p class="text-gray-800 font-semibold text-lg"><?php echo e($publicacion->empleador->user->name); ?>

                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['onclick' => 'window.location.href=\''.e(route('empleador.perfil', ['id' => $publicacion->empleador->id])).'\'','class' => 'ms-4 bg-[#9DBEBB]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['onclick' => 'window.location.href=\''.e(route('empleador.perfil', ['id' => $publicacion->empleador->id])).'\'','class' => 'ms-4 bg-[#9DBEBB]']); ?>
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
                                </p>
                                <p class="text-gray-600 mt-2"><?php echo e($publicacion->descripcion); ?></p>
                                <!-- Dirección con estilo -->
                                <p class="text-gray-700 font-medium mt-2">
                                    <span class="block text-sm text-gray-500">Ubicado en </span>
                                    <a href="https://www.google.com/maps?q=<?php echo e(urlencode($publicacion->direccion)); ?>" 
                                    target="_blank" 
                                    class="text-indigo-600 font-semibold hover:text-indigo-800 transition-colors duration-200">
                                        <?php echo e($publicacion->direccion); ?>

                                    </a>
                                </p>

                                <p class="text-sm text-gray-500">Estado: <span class="font-semibold"><?php echo e($publicacion->estado); ?></span></p>
                                <p class="text-gray-600"><?php echo e(\Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y')); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>No hay publicaciones disponibles de empleadores. ¡Mantente atento a las nuevas ofertas!</p>
                    <?php endif; ?>
                </div>
            </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('openModal').addEventListener('click', function () {
            document.getElementById('modal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('modal').classList.add('hidden');
        });

        document.getElementById('modal').addEventListener('click', function (event) {
            if (event.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
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
<?php /**PATH C:\laragon\www\oficio_web\resources\views/dashboard/empleador.blade.php ENDPATH**/ ?>
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-6">
                        <?php if($empleador->foto_perfil): ?>
                            <img src="<?php echo e(asset('storage/fotos_perfil/' . $empleador->foto_perfil)); ?>" 
                                 alt="Foto de Perfil" 
                                 class="rounded-full w-32 h-32 mr-6">
                        <?php endif; ?>
                        <div>
                            <h1 class="text-2xl font-bold"><?php echo e($empleador->user->name); ?></h1>
                            <?php if($empleador->dni): ?>
                                <p><strong>DNI:</strong> <?php echo e($empleador->dni); ?></p>
                            <?php endif; ?>
                            <?php if($empleador->telefono): ?>
                                <p><strong>Teléfono:</strong> <?php echo e($empleador->telefono); ?></p>
                            <?php endif; ?>
                            <?php if($empleador->direccion): ?>
                                <p><strong>Dirección:</strong> <?php echo e($empleador->direccion); ?></p>
                            <?php endif; ?>
                                </div>
                            </div>

                    <h2 class="text-xl font-semibold mb-4">Publicaciones</h2>
                    
                    <?php if($publicaciones->isNotEmpty()): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="p-6 border rounded-lg bg-gray-100 shadow-md">
                                    <p class="text-gray-800 text-lg"><?php echo e($publicacion->descripcion); ?></p>
                                    
                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Ubicación:</span>
                                        <?php echo e($publicacion->direccion); ?>

                                    </p>

                                    <p class="text-gray-700 font-medium mt-2">
                                        <span class="block text-sm text-gray-500">Estado:</span>
                                        <?php echo e($publicacion->estado); ?>

                                    </p>

                                    <p class="text-gray-600 mt-2 text-sm">
                                        <span class="font-medium text-gray-500">Publicado el:</span> 
                                        <?php echo e(\Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y')); ?>

                                    </p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">No hay publicaciones disponibles.</p>
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
<?php endif; ?><?php /**PATH C:\laragon\www\oficio_web\resources\views/empleador/perfil.blade.php ENDPATH**/ ?>
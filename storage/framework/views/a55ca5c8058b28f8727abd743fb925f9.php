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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6">Crear Nueva Publicación</h2>

                <?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('publicacion.store')); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">
                            Descripción del Trabajo
                        </label>
                        <textarea 
                            id="descripcion" 
                            name="descripcion" 
                            rows="4" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Describe los detalles del trabajo, requisitos, responsabilidades..."
                            required
                        ><?php echo e(old('descripcion')); ?></textarea>
                    </div>

                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700">
                            Estado del Empleo
                        </label>
                        <select 
                            id="estado" 
                            name="estado" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option value="">Selecciona un estado</option>
                            <option value="Tiempo Completo" <?php echo e(old('estado') == 'Tiempo Completo' ? 'selected' : ''); ?>>Tiempo Completo</option>
                            <option value="Medio Tiempo" <?php echo e(old('estado') == 'Medio Tiempo' ? 'selected' : ''); ?>>Medio Tiempo</option>
                            <option value="Temporal" <?php echo e(old('estado') == 'Temporal' ? 'selected' : ''); ?>>Temporal</option>
                            <option value="Por Proyecto" <?php echo e(old('estado') == 'Por Proyecto' ? 'selected' : ''); ?>>Por Proyecto</option>
                        </select>
                    </div>

                    <div>
                        <label for="direccion" class="block text-sm font-medium text-gray-700">
                            Dirección
                        </label>
                        <input 
                            type="text" 
                            id="direccion" 
                            name="direccion" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Ingresa la dirección del trabajo"
                            value="<?php echo e(old('direccion')); ?>"
                            required
                        >
                    </div>

                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="bg-[#031926] text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
                        >
                            Crear Publicación
                        </button>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH C:\laragon\www\app-oficioweb\resources\views/publicaciones/create.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Crear nueva publicación</h2>
    
    <form method="POST" action="<?php echo e(route('publicacion.store')); ?>">
        <?php echo csrf_field(); ?>
        
        <!-- Descripción -->
        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo e(old('descripcion')); ?>" class="mt-1 block w-full border border-gray-300 rounded-md" required>
        </div>

        <!-- Dirección -->
        <div class="mb-4">
            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo e(old('direccion')); ?>" class="mt-1 block w-full border border-gray-300 rounded-md" required>
        </div>

        <!-- Estado -->
        <div class="mb-4">
            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
            <select id="estado" name="estado" class="mt-1 block w-full border border-gray-300 rounded-md" required>
                <option value="activo" <?php echo e(old('estado') == 'activo' ? 'selected' : ''); ?>>Activo</option>
                <option value="inactivo" <?php echo e(old('estado') == 'inactivo' ? 'selected' : ''); ?>>Inactivo</option>
            </select>
        </div>

        <!-- Botón de enviar -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Crear Publicación</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\app-oficioweb\resources\views\publicaciones\create.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
<div>
    <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="publicacion">
            <p><?php echo e($publicacion->descripcion); ?></p>
            <p><?php echo e($publicacion->direccion); ?></p>
            <a href="<?php echo e(route('login')); ?>">Leer más</a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\app-oficioweb\resources\views\publicaciones\mostrar.blade.php ENDPATH**/ ?>
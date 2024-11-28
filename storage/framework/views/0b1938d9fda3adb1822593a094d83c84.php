<section class="py-4">
    <div class="container">
        <h1 class="text-center mb-4">Resultados</h1>

        <?php if($publicaciones->isEmpty()): ?>
            <div class="alert alert-warning" role="alert">
                No se encontraron publicaciones para este oficio.
            </div>
        <?php else: ?>
            <div class="row">
                <?php $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($publicacion->descripcion); ?></h5>
                                <p class="card-text">Publicado por: <?php echo e($publicacion->empleador->user->name); ?></p>
                                <p class="card-text text-muted"><?php echo e(\Carbon\Carbon::parse($publicacion->fecha_publicacion)->format('d/m/Y')); ?></p>
                                <p class="card-text">Dirección: <?php echo e($publicacion->direccion); ?></p>

                                <?php if(auth()->guard()->check()): ?>
                                    <a href="<?php echo e(route('ver.publicacion', $publicacion->id)); ?>" class="btn btn-primary">Ver más</a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-secondary">Iniciar sesión</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="mt-4">
                <?php echo e($publicaciones->links('pagination::bootstrap-4')); ?>

            </div>
        <?php endif; ?>
    </div>
</section><?php /**PATH C:\laragon\www\app-oficioweb\resources\views\publicaciones\buscar.blade.php ENDPATH**/ ?>
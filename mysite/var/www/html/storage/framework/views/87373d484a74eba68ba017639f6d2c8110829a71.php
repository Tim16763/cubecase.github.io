<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><img src="<?php echo e($item->img); ?>" alt="<?php echo e($item->name); ?>"/></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $last; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<a class="live-feed__item" href="/user/<?php echo e($item->user->id); ?>/" rel="<?php echo e($item->user->name); ?>" style="background: url(<?php echo e($item->item->img); ?>) #3f3a30 center center no-repeat;"><span class="live-feed__item-border"><span class="live-feed__item--hover"><span class="live-feed__item-avatar-border"><span class="live-feed__item-avatar" style="background: url(<?php echo e($item->user->avatar); ?>) center center no-repeat;"></span></span><span class="live-feed__item-personaname"><?php echo e($item->user->name); ?></span></span></span></a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
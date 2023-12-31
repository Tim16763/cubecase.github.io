<?php $__env->startSection('content'); ?>
    <div class="ceys_full full">
        <div class="ceys_title"><b><a href="/" style="color: #46b588;">ГЛАВНАЯ</a> / </b>Что может выпасть?</div>
        <div class="item_loop2">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->id !== 1): ?>
                    <div class="items">
                        <div class="item_price"><?php echo e($item->sell_price); ?></div>
                        <div class="item_images1">
                            <img src="<?php echo e($item->img); ?>" alt="<?php echo e($item->name); ?>"/>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a class="btn-price-for-main" href="/"><div class="main_btn"><span>ИСПЫТАТЬ УДАЧУ</span> <b>99 руб.</b></div></a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
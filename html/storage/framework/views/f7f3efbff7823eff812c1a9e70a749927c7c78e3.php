

<?php $__env->startSection('content'); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
    <style>.prizget1 {
            padding-top: 6px;
            text-align: center;
            font-weight: bold;
            color: #776c45;
            font-size: 13px;
        }</style>
    <div class="ceys_full full">
        <div class="ceys_title"><b><a href="/">ГЛАВНАЯ</a> / <a href="/account">ЛИЧНЫЙ КАБИНЕТ</a> / </b>Продажа выигрыша</div>
        <div class="item_loop">
            <div class="contentget">
              <div class='text2gets'>
                  <p><?php echo e($status); ?></p>
              </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
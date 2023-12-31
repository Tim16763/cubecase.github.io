<?php $__env->startSection('content'); ?>
<link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
<style>
.prizget1 {
  padding-top: 6px;
  text-align: center;
  font-weight: bold;
  color: #776c45;
  font-size: 13px;
}
</style>
    <div class="ceys_full full">
        <div class="ceys_title">ВАШ ПРИЗ:</div>
        <div class="item_loop">
            <div class="contentget">
                <div class="headerget">
                    <div class="left"><img src="<?php echo e($live->item->img); ?>" alt=""/></div>
                    <div class="right">
                        <span class="gamenameget"><?php echo e($live->item->name); ?></span><br/>
                        <div class="gameitem">
                            <p class='getinfo'>КОД</p>
                            <p class='prizgetkey'><?php echo e($live->key); ?></p></div>
                    </div>
                </div>
                <hr color="#ededed" size="1px" class="getitemhr">
                <div class="footerget">
                    <p class='text1gets'>КАК ЗАБРАТЬ АККАУНТ?</p>
                    <div class='text2gets'>
                        <p> 1. Перейдите в нашу группу ВКонтакте.</p>
                        <p> 2. Напишите в сообщения группы код.</p>
                        <p> 3. Ожидайте пока вам выдадут ваш приз.</p>
                    </div>
                    </script>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
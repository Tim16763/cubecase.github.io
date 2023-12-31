<?php $__env->startSection('content'); ?>
    <div class="feedback_full full">
        <div style="margin-bottom:35px;" class="category">Отзывы</div>
        <div id="vk_comments" class="feedback_container">

            <script type="text/javascript">
                VK.init({apiId: 6825580, onlyWidgets: true});
            </script>

            <div id="vk_comments"></div>
            <script type="text/javascript">
                VK.Widgets.Comments("vk_comments", {
                    limit: 15,
                    width: "665",
                    attach: false,
                    pageUrl: "https://<?php echo e($config->namesite); ?>/feedback/"
                });
            </script>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
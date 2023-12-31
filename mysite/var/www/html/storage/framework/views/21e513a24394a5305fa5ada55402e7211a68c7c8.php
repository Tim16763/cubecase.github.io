<?php $__env->startSection('content'); ?>
<style>#modalWin.modal{text-align:center;background:url(/images/modal.png) no-repeat;width:485px;height:453px;z-index:25;left:50%;top:50%;margin-left:-242px}#modalWin .modal-close{display:block;width:27px;height:28px;background:url(/images/modal-close.png) no-repeat;position:absolute;top:9px;right:13px;cursor:pointer}#modalWin .modal-title{display:block;color:#fff;font-size:25px;text-transform:uppercase;height:74px;line-height:86px;text-align:center;text-shadow:0 0 20px rgba(56,47,34,.75)}#modalWin .modal-item{width:139px;height:190px;margin:20px auto 0}#modalWin .item--rare{background:url(/images/modal-tem.png) no-repeat #f2bf0f}#modalWin .modal-item__image{width:130px;height:183px;background-size:130px auto!important;position:relative;top:3px;left:4px}#modalWin .modal-info{margin:20px auto 0;width:400px;height:75px}#modalWin .modal-info__inner{font-family:OpenSansCondBold,sans-serif;padding:15px 20px;background:#80d6e4;margin:0 auto;width:360px;max-height:45px;border-radius:20px;border:4px solid #c4f5ff;color:#fff;font-size:16px;text-overflow:clip;overflow:hidden;word-wrap:break-word;line-height:1.2;letter-spacing:.5px;position:relative;left:-4px}#modalWin .modal-info__pass{display:block}#modalWin .modal__profile-button{display:inline-block!important;margin:0 5px;position:relative;bottom:-20px}#modalWin .profile-button,.profile-button__text{display:block;width:204px;height:67px;text-decoration:none!important;color:#fff!important}#modalWin .profile-button{background:url(/images/modal-button.png);font-size:16px;text-transform:uppercase}#modalWin .profile-button:not(:hover) .profile-button--hover{opacity:0;transition:opacity .5s ease}#modalWin .profile-button--hover{display:block;background:url(/images/modal-button.png) 0 67px;width:204px;height:67px}#modalWin .profile-button__text{position:relative;top:-67px;text-align:center;line-height:69px}

#container-chance {
    position: relative;
    left: 645px;
    top: 312px;
    box-shadow: 0 5px 45px 0 rgb(232, 121, 10);
}
.container-addbutton:not(:hover) {
    font-size: 18px;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.container-addbutton:hover {
    font-size: 19px;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.container-addbutton {
    font-size: 18px;
    height: 50px;
    width: 300px;
    background: rgb(220, 109, 4);
    font-weight: 600;
    color: #fff;
    border-radius: 50px;
    text-align: center;
    cursor: pointer;
}
.container-addbutton-text {
    color: #ffffff;
    position: relative;
    top: 13px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    opacity: 1 !important;
}
.container-addbutton .active {
    color: #1c1c1b;
}
.container-addbutton span {
    display: inline!important;
    float: none!important;
    color: #fff;
    margin: 0 0 0 6px;
    opacity: 1 !important;
}
</style>
<div style="display: none;">
<div class="modal" id="modalWin" style="top: 50%; opacity: 1;">
<div class="modal-close arcticmodal-close"></div>
<div class="modal-title"></div>
<div class="modal-item item--common"><div class="modal-item__image" style="background:url(#) center center no-repeat"></div></div>
<div class="modal-info">
<div class="modal-info__inner">
<div class="modal-info__pass">*********************************************************************</div>
</div>
</div>
<div class="profile-button modal__profile-button modal-button-fade">
<div class="profile-button--hover"></div><a class="profile-button__text" href="#">Продать</a>
</div>
<div class="profile-button modal__profile-button">
<div class="profile-button--hover"></div><a class="profile-button__text" href="#">Забрать приз</a>
</div>
</div>
</div>

    <div class="ceys_full full" data-name="<?php echo e($case->name); ?>" data-id="<?php echo e($case->id); ?>">
        <div class="hidden">
            <div class="ceys_title" style="color:#eccb6b;text-shadow: 0 0 30px rgb(164, 100, 19);"><?php echo e($case->name); ?></div>
        </div>
        <div class="rulet_full full">
            <div class="rulet_title">
                <b><em><FONT color="white">ВАША ИГРА</FONT></em></b> <span><em><FONT color="white">испытайте удачу</FONT></em></span>
            </div>
            <div class="rulet_btn" id="button_buy">
                <span>ИСПЫТАТЬ УДАЧУ</span> <b data-cost="<?php echo e($case->price); ?>" id="container-cost"><?php echo e($case->price); ?> руб.</b>
            </div>
            <div class="rulet">
                <ul>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><img src="<?php echo e($item->img); ?>" alt="<?php echo e($item->name); ?>"/></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
          <div class="container-addbutton" id="container-chance" data-chance="0">
            <div class="container-addbutton-text">ШАНС: <span id="container-chance-zero" class="active">+0%</span> <span id="container-chance-five">+15%</span> <span id="container-chance-ten">+25%</span> <span id="container-chance-fif">+50%</span></div>
          </div>
        </div>
        <div class="ceys_title">Содержимое кейса</div>
        <div class="item_loop2">
            <?php $__currentLoopData = $demoItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="items">
                <?php if($item->sell_price !== 0): ?>
                <div class="item_price"><?php echo e($item->sell_price); ?></div>
                <?php endif; ?>
                <div class="item_images1">
                    <img src="<?php echo e($item->img); ?>" alt="<?php echo e($item->name); ?>"/>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <script type="text/javascript">
        var categoryRulet = "<?php echo e($case->name); ?>";
        var priceRulet = "<?php echo e($case->price); ?>";
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
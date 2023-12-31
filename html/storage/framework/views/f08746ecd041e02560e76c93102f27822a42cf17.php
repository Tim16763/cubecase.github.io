<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" type="text/css" href="/css/lk_style.css?3">
    <link rel="stylesheet" type="text/css" href="/css/switchery.min.css">
    <div style="display: none;"><div class="modal" id="infoSell" style="width:600px;height: 50px;"><div class="modal_close arcticmodal-close"></div><div class="hidden"><center></center></div></div></div>
    <center>
        <div class="category">ЛИЧНЫЙ КАБИНЕТ</div>
        <div class="ceys_full full lk-content" style="font-family: Open Sans;">
            <div class="lk-left-column">
                <img src="<?php echo e($u->avatar); ?>"
                     class="lk-img">
                <div class="info-block">
                    <div class="lk-margin" style="margin-bottom:-15px">
                        <span class="green bold balance_icon">Баланс: </span>
                        <span class="grey bold"><?php echo e($u->balance); ?> руб</span>
                    </div>
                    <div class="lk-margin relative">
                        <span class="lk-label">Ваша реферальная ссылка:</span>
                        <input type="text" id="ref_url" class="lk-ref" name="ref"
                               value="https://<?php echo e($config->namesite); ?>/?ref=<?php echo e($u->affiliate_code); ?>">
                    </div>
                    <div class="lk-margin relative">
                        <span class="lk-label">Показывать ссылку на ваш профиль:</span>
                        <input type="checkbox" class="js-switch js-check-change" <?php if($u->h==0): ?> checked <?php endif; ?> />
                        <span class="lk-label js-check-change-field" style="display:inline-block;"><?php if($u->h==0): ?> Показывать <?php else: ?> Скрывать <?php endif; ?></span>
                    </div>
                    </script>
                </div>
            </div>
            <div class="lk-right-column">
                <div class="lk-nav-tab">
                    <span class="bold lk-h1 " data-tab="games"> ваши игры</span>
                    <span class="bold lk-h1 noactive" data-tab="referers"> реферальная система</span>
                    <span class="bold lk-h1 noactive" data-tab="promo"> промокоды</span>
                </div>
                <div class="clear"></div>

                <div class="tab-content" id="games" style="">
                    <div class="item_loop2">
                        <?php $__currentLoopData = $wins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $win): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="items">
                                <div class="item_images1">
                                    <img src="<?php echo e($win->item->img); ?>" alt=""/>
                                    <?php if($win->vi==0): ?>
                                    <a href="/get/<?php echo e($win->id); ?>/" class="item_open1">Получить</a>
                                    <a onClick="sellItem(<?php echo e($win->id); ?>); return false;" class="item_open1 item1down">Продать</a>
                                    <?php elseif($win->vi==1): ?>
                                    <a href="/get/<?php echo e($win->id); ?>/" class="item_open1">Открыть</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="tab-content" id="referers" style="display: none;">
                    <span class="lk-info">Вы можете заработать на кейс прямо у нас на сайте. Для этого вам нужно приглашать друзей и знакомых на сайт по вашей реферальной ссылке. Вы будете получать 5% от каждого пополнения.</span>
                    <div class="block-url-ref">
                        <span class="lk-label-ref">Ваша реферальная ссылка:</span>
                        <input type="text" class="ref-url"
                               value="https://<?php echo e($config->namesite); ?>/?ref=<?php echo e($u->affiliate_code); ?>">
                    </div>
                    <ul class="list-info">
                        </li>
                        <li>Вы пригласили пользователей: <span class="grey"><?php echo e($count_ref); ?></span></li>
                        <li>Вы заработали: <span class="grey"><?php echo e($u->affiliate_profit); ?> р.</span></li>
                    </ul>
                    <div class="block-url-ref" style="margin-top: 100px;">
                        <span class="lk-label-ref">Поделиться и начать зарабатывать:</span>
                        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                        <script src="//yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" id="my-share2"
                             data-services="collections,vkontakte,twitter,facebook,viber,skype,telegram"
                             data-counter=""></div>
                    </div>
                </div>

                <div class="tab-content" id="promo" style="display: none;">
                    <span class="lk-info">Вводите промокод</span>
                    <div class="block-url-ref">
                        <span class="lk-label-ref">Промокод:</span>
                        <input type="text" class="ref-url" id="code" style="width: 89%"
                               value="" placeholder="FREE">
                        <button style="height: 45px;line-height: 32px;text-align: center;position: absolute;background: #eccb6b;color: #fff;z-index: 77; border-radius: 3px; padding: 5px;font-weight: bold;cursor: pointer;" onclick="promocodeUse()">Принять</button>
                    </div>
                </div>

            </div>
        </div>
    </center>
    <script type="text/javascript" src="/js/switchery.min.js"></script>
    <script type="text/javascript">
        var init = new Switchery(document.querySelector('.js-switch'), {color: '#0040b5', jackColor: '#00ddeb', secondaryColor: '#2d8086'});
        var changeCheckbox = document.querySelector('.js-check-change'),changeField = document.querySelector('.js-check-change-field');
        changeCheckbox.onchange = function() {
          changeField.innerHTML = (changeCheckbox.checked ? "Показывать" : "Скрывать");
          $.ajax({method: 'POST', url: '/api/profile?h='+changeCheckbox.checked});
        };
        var share = Ya.share2('my-share2', {
            content: {
                url: 'https://<?php echo e($config->namesite); ?>/?ref=<?php echo e($u->affiliate_code); ?>',
                title: '<?php echo e($config->namesite); ?> » Выигрывай с нами',
                description: '<?php echo e($config->namesite); ?> » Выигрывай с нами! \nВыигрывайте привелигии с серверов и аккаунты с Нами! \nВ LIVE-ленте отображаются полученные выигрыши наших реальных клиентов! \nПроцесс полностью автоматизирован!',
                image: 'https://<?php echo e($config->namesite); ?>/images/banner.png'
            }, theme: {counter: false}
        });
        var promocodeUse = function () {
            $.ajax({
                method: 'POST', url: '/api/promocodeUse?code='+$('#code').val(), success: function (data) {
                    $('#modal_error_header').text(data.message);
                    $('#modal_error_message').html('<a class="login arcticmodal-close" style="cursor: pointer">Закрыть</a>');
                    $('#modal_error').arcticmodal();
                }
            });
        }
        var sellItem = function (id) {
            $.ajax({
                method: 'POST', url: '/api/sellItem?id='+id, success: function (data) {
                  $('#infoSell center').html(data.info);
                  $('#infoSell').arcticmodal();
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
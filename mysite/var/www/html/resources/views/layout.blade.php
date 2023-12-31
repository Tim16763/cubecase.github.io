<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="yandex-verification" content="20fc931bea61d42b" />
    <meta name="google-site-verification" content="KSvvz0K4ezdDZlAw7HiCIA5jO249weuexxOTC4--b50" />
    <title>Cubecase » Выигрывай с нами.</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css?v=98"/>
    <link rel="shortcut icon" href="/images/favicon.ico"/>
    <script src="https://vk.com/js/api/openapi.js?155" type="text/javascript"></script>
    <meta name = "description" content = "Сайт по открытию кейсов разных привилегий с разных серверов игры Minecraft: VimeWorld, Hypixel, LiteCloud, Mineplex. Помимо привилегий, на сайте Вы можете выбить другие полезные вещи: аккаунты, росписи и сигны от ютуберов, а также разговор в скайпе с ними. Испытай удачу прямо сейчас." />
    <meta name = "keywords" content = "Minecraft, case, hypixel, vimeworld, mineplex, youtube, привилегии, майнкрафт, ютуберы, майнкрафт, кейс, майнкрафт кейс, кейсы майнкрафт, рулетка майнкрафт, рулетка" />
    <meta property="og:title" content="Cubecase » Выигрывай с нами."/>
    <meta property="og:image" content="https://{{$config->namesite}}/images/banner.png"/>
    <meta property="og:url" content="https://{{$config->namesite}}/"/>
    <meta property="og:description" content="Сайт по открытию кейсов разных привилегий с разных серверов игры Minecraft: VimeWorld, Hypixel, LiteCloud, Mineplex. Помимо привилегий, на сайте Вы можете выбить другие полезные вещи: аккаунты, росписи и сигны от ютуберов, а также разговор в скайпе с ними. Испытай удачу прямо сейчас."/>
     <style>
  {margin : 0; padding : 0;}
  
  body {
   background-color : #6b92b9;
  }
  </style>
<script type="text/javascript" src="/js/jquery-1.9.1.js"></script>
</head>
<body>
<div style="display:none;">
    <div class="modal" id="modal2" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title"><b><em>Пополнение</b> баланса</em></div>
        <div class="hidden">
            <div class="balance">
                <form method='get'>
                    <div class="balance_text">Введите сумму на которую хотите пополнить счет и нажмите кнопку
                        пополнить.
                    </div>
                    <input type='text' name='cent' value='100'>
                    <div class='clear'></div>
                    <input type="submit" id="submit" value="ПОПОЛНИТЬ БАЛАНС">
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="modal3" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title"><b><em>Пополнение</b> баланса</em></div>
        <div class="hidden">
            <div class="balance">
                <form method='get'>
                    <div class='balance_text'>На Вашем балансе недостаточно средств, для участия в игре. Пожалуйста
                        пополните счет на сумму не менее <b id="refill_rub"></b> рублей
                    </div>
                    <input type='text' name='cent' id='refill_input' value=''>
                    <div class='clear'></div>
                    <input type="submit" id="submit" value="ПОПОЛНИТЬ БАЛАНС">
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="modal4" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Поздравляем!</div>
        <div class="hidden">
            <div class="balance">
                <center><h4 style="font-size: 15px;"><em>Ваш выигрыш</em></h4></center>
                </br>
                <div class="balance_text" id="prizimgpopop"></div>
                <div class="clear"></div>
                <p>Ваш выигрыш будет находиться в вашем личном кабинете, пока вы его не заберете.</p></br>
                <input type="submit" onClick="window.location='/account'" value="ЗАБРАТЬ ПРИЗ"/>
                <input type="submit" onClick="window.location='/sell'" value="ПРОДАТЬ ПРИЗ"/>
            </div>
        </div>
    </div>
    <div class="modal" id="modal5" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Упс!</div>
        <div class="hidden">
            <div class="balance">
                <center><h4 style="font-size: 15px;"><em>Товар закончилися</em></h4></center>
                </br>
                <div class="balance_text">
                    <p>К сожалению, в данный момент товар закончился. Попробуйте позже. Скоро мы добавим его. Спасибо
                        за понимание</p></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal6" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Email</div>
        <div class="hidden">
            <div class="balance">
                <center><h4 style="font-size: 15px;"><em>Оповещения</em></h4></center>
                </br>
                <div class="balance_text">
                    <p>Мы будем оповещать вас о новых играх и акциях</p></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal_error" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title"><em>Ооооо!</em></div>
        <div class="hidden">
            <div class="balance">
                <center><h4 style="font-size: 15px;" id="modal_error_header"></h4></center>
                </br>
                <div class="balance_text">
                    <p id="modal_error_message"></p></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="modal" id="auth" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Авторизируйтесь!</div>
        <div class="hidden">
            <div class="balance">
                <center><h4 style="font-size: 15px;">Чтобы играть, вам нужно авторизироваться</h4></center>
                </br></br>
                <a href="/auth/vkontakte" class="login" style="top: 124px;">Войти через vk</a>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="modal" id="vksubs" style="width:600px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="hidden">
          <center>Подпишитесь на наше сообщество, чтобы получать бонусы и промокоды!<br><br>
          <div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 1,width: "500", height: "400", no_cover: 1}, 162279955);
</script>
          </center>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="header">
        <div class="full">
            <a href="/" class="logo"></a>
            @if(Auth::guest())
                <div class="auth-block">
				<a href="/auth/vkontakte">
				<div class="button" style="margin-left:115px;bottom:180px;"><span>Войти через</span> <b><img src="/images/icons/vk_big.png" style="height:20px;position: absolute;top:10px;left:150px;"></b></div>
				</a>
                </div>
            @else
                <div class="panel">
                    <div class="mini_profile">
                        <div class="mini_profile_ava"><a href="/account/"><img src="{{$u->avatar}}" alt=""/></a></div>
                        <div class="hidden">
                            <div class="mini_profile_login ell"><a href="/account/" style="color:#fff;">{{$u->name}}</a>
                            </div>
                            <div class="mini_profile_balance left">
                                Баланс: <b id="balanceuser">{{$u->balance}} Руб.</b>
                            </div>
                            <div class="mini_profile_payment">
                                <a href="/oplata/" class="btn-header btn-balance">Пополнить</a>
                            </div>
                            <div class="mini_profile_right">
                                <a href="/account/"><img src="/images/profile.png?8"></a>
                                <a href="/logout/"><img src="/images/leave.png?8"></a>
                            </div>
                        </div>
                    </div>
                    <div class="header-nav">
                        <a href="{{$config->vkgroup}}" target="_blank" class="btn-header btn-vk">Мы ВКонтакте</a>
                        <a href="https://{{$config->namesite}}/account/?=ref" class="btn-header btn-open-free">Открывай бесплатно!</a>
                    </div>
                </div>
            @endif
            <div class="nav">
                <ul>
                    <li><a href="/feedback/">Отзывы</a></li>
                    <li><a href="/garant/">Гарантии</a></li>
                    <li><a href="/faq/">F.A.Q</a></li>
                    <li><a href="{{$config->vkgroup}}" target="_blank">Конкурсы и раздачи</a></li>
                    @if(Auth::guest())
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="last_full">
    <div class="last_loop">
        <div class="live-feed" id="liveFeed">
            <ul>
            </ul>
        </div>
    </div>
</div>
@yield('content')
<style>
.modal_title {
    color: #fff;
}
.item:hover {
    transform: scale(1.05);
    transition: all 0.5s ease-in-out;
}
.social_event {
    text-align: center;
    width: 874px;
    margin: 0 auto;
}

.social_event .white_bg {
    margin: 40px 0;
    position: relative;
    background: #fff;
    padding: 0 0 0 0;
    border: 0;
    border-radius: 2px;
    overflow: hidden;
}

.social_image {
    position: relative;
}

.social_image img {
    max-width: 100%;
    width: 100%;
}

.offering-text {
    position: absolute;
    top: 35px;
    left: 50%;
    margin-left: -91px;
}

.offering-text p {
    font-size: 24px;
    color: #ffffff;
    font-weight: 600;
}

.social_event .white_bg .btn {
    margin: 0;
    margin-left: -98px;
    color: #fff;
    background: rgba(255,255,255,0.3);
    border: 2px solid #ffffff;
    font-size: 16px;
    padding: 0 36px;
    font-weight: 600;
    transition: all 0.2s ease;
    position: absolute;
    top: 116px;
    outline: none;
    cursor: pointer;
    display: inline-block;
    text-align: center;
    line-height: 43px;
    vertical-align: top;
    text-decoration: none;
    text-transform: uppercase;
    border-radius: 3px;
}

.social_event .white_bg .btn img {
    display: inline-block;
    margin-left: 15px;
}
.white_bg:hover {
    transform: scale(1.05);
    transition: all 0.5s ease-in-out;
}
</style>
<div class="stats">
    <ul>
        <li><b>0</b>Открыто кейсов</li>
        <li><b>0</b>Пользователей</li>
        <li><b>
                <div class="onlineWidget">
                    <div class="count">1</div>
                </div>
            </b>Всего online
        </li>
    </ul>
</div>
</div>
<div class="footer full">
<div class="footer full">
<div class="footer full">
    <h1><em>Cubecase</em> » Выигрывай с нами</h1>
    <p>Мы работаем на прямую с создателями серверов и закупаем привилегии только у них!</p>
    <p>На нашем сайте вы можете открыть различные кейсы с привилегиями по самым выгодным ценам!</p>
    <br/>
</div>
</div>
<a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/21.png"></a>
</script>
<script type="text/javascript">
    var server_time = "<?php echo date('o-m-d H:i:s') ?>";
</script>
<script type="text/javascript" src="/js/jquery.arcticmodal-0.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.animateNumber.min.js"></script>
<script type="text/javascript" src="/js/moment.js"></script>
<script type="text/javascript" src="/js/slider.js"></script>
<script src="https://cdn.rawgit.com/zenorocha/clipboard.js/master/dist/clipboard.min.js"></script>
<script type="text/javascript" src="/js/script.js?v=27"></script>
<script type="text/javascript" src="/js/ion.sound.min.js"></script>
<script type="text/javascript" src="/js/core.js?v=34"></script>
</body>
</html>
<?php
@session_start();
if (isset($_GET['ref'])) {
    $_SESSION['ref'] = $_GET['ref'];
}
?>
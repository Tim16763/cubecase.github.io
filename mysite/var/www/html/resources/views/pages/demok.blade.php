<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>КЕЙС “{{$case->name}}”</title>
    <link rel="stylesheet" type="text/css" href="/css/opensans/opensans.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css?v=14" />
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <script src="https://vk.com/js/api/openapi.js?135" type="text/javascript"></script>
    <meta property="og:title" content="KEYS-UP.ru - Выиграй топовую игру всего за 59р!" />
    <meta property="og:image" content="https://cheapkeys.ru/images/logoog.png" />
    <meta property="og:url" content="https://cheapkeys.ru/" />
    <script>

                @if(Auth::guest())
        var login = 0;

                @else
        var login = {{Auth::user()->id}};
        @endif
    </script>
</head>

<body>
<style>
    .demo-mode {
        position: fixed;
        background: #ff9800;
        color: #fff;
        text-align: center;
        font-weight: 700;
        transition: opacity 1s ease-out;
        display: none;
        top: 0px;
        width: 100%;
        z-index: 999;
    }
    .demo-mode {
        position: fixed;
        background: #ff9800;
        color: #fff;
        text-align: center;
        font-weight: 700;
        transition: opacity 1s ease-out;
        display: none;
        top: 0px;
        width: 100%;
        z-index: 999;
    }
    .fr {
        float: right;
    }
</style>
<div class="demo-mode" style="display: block;">
    <span>Включен демо режим <div class="fr"><a href="/case/{{$case->id}}" class="detect-demo">Выключить</a></div></span></div>
<div style="display:none;">
    <div class="modal" id="modal1" style="width:810px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title"><b>Наши</b> гарантии</div>
        <div class="hidden">
            <div class="garant">
                <div class="garant_i">
                    <div class="garant_name">Надежно</div>
                    <div class="garant_text">
                        Все платежные реквизиты и личные кабинеты Клиентов, защищены SSL технологиями шифрования! Дружелюбная Тех.Поддержка всегда с радостью ответит на все имеющиеся вопросы! Мы 5 лет занимаемся продажей игр в интернете и имеем Персональный Аттестат в системе Webmoney с большим бизнес уровнем!
                    </div>
                </div>
                <div class="garant_i">
                    <div class="garant_name">Честно</div>
                    <div class="garant_text">
                        Мы ничего не скрываем перед нашими клиентами! Все чисто! Ваш выигрыш определяет только рандом и мы никак не можем вмешаться в процесс. Тут Вы по-настоящему можете испытать свою удачу. Самое главное, это возможность получить Дорогую игру, при этом оплатив всего 99 руб (при покупке общего кейса). В LIVE-ленте отображаются полученные игры наших реальных клиентов!
                    </div>
                </div>
                <div class="garant_i">
                    <div class="garant_name">Быстро</div>
                    <div class="garant_text">
                        Процесс полностью автоматизирован! Вам не придется посещать кучу сайтов для оплаты и получения игры. Окно с инструкцией по активацией игры появится мгновенно! А если вы хотите растянуть сладостное мгновение, отложите активацию ключа на некоторое время.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal2" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title"><b>Пополнение</b> баланса</div>
        <div class="hidden">
            <div class="balance">
                <form method='get'>
                    <div class="balance_text">Введите сумму на которую хотите пополнить счет и нажмите кнопку пополнить.
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
        <div class="modal_title"><b>Пополнение</b> баланса</div>
        <div class="hidden">
            <div class="balance">
                <form method='get'>
                    <div class='balance_text'>На Вашем балансе недостаточно средств, для участия в игре. Пожалуйста пополните счет на сумму не менее <b id="refill_rub"></b> рублей</div>
                    <input type='text' name='cent' id='refill_input' value=''>
                    <div class='clear'></div>
                    <input type="submit" id="submit" value="ПОПОЛНИТЬ БАЛАНС">
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="modal4" style="width:250px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Поздравляем!</div>
        <div class="hidden">
            <div class="balance">
                <center>
                    <h4 style="font-size: 15px;">Ваш выигрыш</h4>
                </center>
                </br>
                <div class="balance_text" id="prizimgpopop"></div>
                <div class="clear"></div>
                <p>Ваш выигрыш будет находиться в вашем личном кабинете, пока вы его не заберете.</p>
                </br>
                <input type="submit" onClick="window.location='/account'" value="ЗАБРАТЬ ПРИЗ" />
            </div>
        </div>
    </div>
    <div class="modal" id="modal5" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Упс!</div>
        <div class="hidden">
            <div class="balance">
                <center>
                    <h4 style="font-size: 15px;">Игры закончились</h4>
                </center>
                </br>
                <div class="balance_text">
                    <p>К сожалению, в данный момент игры закончились. Попробуйте позже. Скоро мы обновим игры. Спасибо за понимание</p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal6" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Email</div>
        <div class="hidden">
            <div class="balance">
                <center>
                    <h4 style="font-size: 15px;">Оповещения</h4>
                </center>
                </br>
                <div class="balance_text">
                    <p>Мы будем оповещать вас о новых играх и акциях</p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal_error" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Упс!</div>
        <div class="hidden">
            <div class="balance">
                <center>
                    <h4 style="font-size: 15px;" id="modal_error_header"></h4>
                </center>
                </br>
                <div class="balance_text">
                    <p id="modal_error_message"></p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="modal" id="auth" style="width:350px;">
        <div class="modal_close arcticmodal-close"></div>
        <div class="modal_title">Авторизируйтесь!</div>
        <div class="hidden">
            <div class="balance">
                <center>
                    <h4 style="font-size: 15px;">Чтобы играть, вам нужно авторизироваться</h4>
                </center>
                </br>
                </br>
                <br>
                <a href="/login" class="login" style="top: 104px;">Войти через vk</a>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="header">
        <div class="full">
            <a href="/" class="logo"></a>
            <div class="auth-block">
                @if(Auth::guest())
                    <div class="auth-block">
                        <a href="/login">
                            <div class="button" style="    margin-left: 230px;"><span>Войти через</span> <b><img src="/images/icons/vk_big.png" style="
   height: 20px;
       position: absolute;
       top: 10px;
       left: 150px;
"></b>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="panel">
                        <div class="mini_profile">
                            <div class="mini_profile_ava">
                                <a href="/account/"><img src="{{Auth::user()->avatar}}" alt="">
                                </a>
                            </div>
                            <div class="hidden">
                                <div class="mini_profile_login ell"><a href="/account/" style="color:#fff;">{{Auth::user()->username}}</a>
                                </div>
                                <div class="mini_profile_balance left">
                                    Баланс: <b id="balanceuser">{{Auth::user()->money}} РУБ.</b>
                                    <a href="/oplata/" target="_blank" class="btn-header btn-balance"> Пополнить</a>
                                </div>
                                <div class="mini_profile_logout">
                                    <a class="btn-header btn-lk" href="/account/" target="_blank">Кабинет</a> • <a class="btn-header link-lk" href="/logout">Выход</a> •
                                </div>
                            </div>
                        </div>
                        <div class="header-nav">
                            <a href="https://vk.com/cheapkeysru" target="_blank" class="btn-header btn-vk">Мы вконтакте</a>
                            <a href="/demo" target="_blank" class="btn-header btn-open-free">Demo</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="nav">
                <ul>
                    <li><a href="/feedback/">Отзывы</a>
                    </li>
                    <li><a href="#" onclick="$('#modal1').arcticmodal(); return false;">Гарантии</a>
                    </li>
                    <li><a href="/faq/">f.a.q</a>
                    </li>
                    <li><a href="https://vk.com/cheapkeysru" target="_blank">Конкурсы и раздачи</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="last_full">
    <div class="last_title"><b>Последние</b> выигрыши:</div>
    <div class="last_loop">
        <div class="slider" id="slider">
            <ul>
            </ul>
        </div>
    </div>
</div>
<div class="ceys_full full" data-name="{{$case->name}}">
    <div class="hidden">
        <div class="ceys_title">
            <a href="/"><b>ГЛАВНАЯ</b></a> <b>/</b> КЕЙС “{{$case->name}}”
        </div>
    </div>
    <div class="rulet_full full">
        <div class="rulet_title_nik">
            <b><em></em> </b> <span> </span>
        </div>
        <div class="rulet_btn" id="button_buy2">
            <span>ИСПЫТАТЬ УДАЧУ</span> <b>0 руб.</b>
        </div>
        <div class="rulet">
            <ul>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
                <li><img src="{{$items->image}}" alt="{{$items->name}}" />
                </li>
                <li><img src="/images/cheapkey/149.jpg" alt="Случайная игра" />
                </li>
            </ul>
        </div>
    </div>
    <div class="ceys_title">Содержимое кейса</div>
    <div class="item_loop2">
        <div class="items">
            <div class="item_price">0</div>
            <div class="item_images1">
                <img src="{{$items->image}}" alt="{{$items->name}}" />
            </div>
        </div>
        <div class="items">
            <div class="item_images1">
                <img src="/images/cheapkey/149.jpg" alt="Случайная игра"/>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var categoryRulet = "{{$case->name}}";
    var priceRulet = 0;
</script>
<div class="stats">
    <ul>
        <li><b id="cases">0</b>Открыто кейсов</li>
        <li><b id="users">0</b>Пользователей</li>
        <li><b id="online"></b>Всего online</li>
    </ul>
</div>
</div>
<div class="footer full">
    <h1><em>Keys</em>UP.ru - рандом ключи стим (Steam)</h1>
    <p>На нашем сайте вы можете открыть категории или кейсы с играми по самым выгодным ценам.</p>
    <p>Все операции происходят автоматически, без вмешательства администрации.</p>

    <br>
    <br>
    <a href="https://webmoney.ru"><img src="/images/88x31_wm_blue_on_white_ru.png">
    </a>
    <a href="https://passport.webmoney.ru/asp/certview.asp?wmid=217710800979" target="_blank"><img src="/images/passportwebmoney.png" alt="Здесь находится аттестат нашего WM идентификатора 217710800979" border="0">
    </a>
</div>
</div>

<script type="text/javascript">
    var server_time = '{{$time}}';
</script>
<script type="text/javascript" src="/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="/js/jquery.smoothscroll.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.js"></script>
<script type="text/javascript" src="/js/jquery.arcticmodal-0.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.animateNumber.min.js"></script>
<script type="text/javascript" src="/js/moment.js"></script>
<script type="text/javascript" src="/js/slider.js"></script>
<script src="https://cdn.rawgit.com/zenorocha/clipboard.js/master/dist/clipboard.min.js"></script>
<script type="text/javascript" src="/js/script.js?v=2"></script>
<script type="text/javascript" src="/js/ion.sound.min.js"></script>
<script type="text/javascript" src="/js/core.js?v=22"></script>
</body>

</html>
</div>
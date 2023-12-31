function reach_goal(name, params, callback) {
    if (typeof window.yaCounter39708050 === 'undefined') {
        return false;
    }
    try {
        window.yaCounter39708050.reachGoal(name, params, callback);
        return true;
    } catch (e) {
        console.warn(e);
        return false;
    }
}
window.dataLayer = window.dataLayer || [];
var product = {
    id: 'random',
    name: 'Случайная игра',
    price: parseInt(priceRulet, 10),
    category: categoryRulet,
    quantity: 1
};
function setCookie(name,value,days) {var expires = "";if (days) {var date = new Date();date.setTime(date.getTime() + (days*24*60*60*1000));expires = "; expires=" + date.toUTCString();}document.cookie = name + "=" + (value || "")  + expires + "; path=/";}
function getCookie(name) {var nameEQ = name + "=";var ca = document.cookie.split(';');for(var i=0;i < ca.length;i++) {var c = ca[i];while (c.charAt(0)==' ') c = c.substring(1,c.length);if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);}return null;}
window.dataLayer.push({"ecommerce": {"detail": {"products": [product]}}});
var isActiveBonus=0, oldType = "case", newType;
$(document).ready(function () {
    setTimeout(function(){if(!getCookie('vk')){$("#vksubs").arcticmodal();setCookie('vk','ok',1);}},8000);
    if($("#container-chance").length){
      var chance = $("#container-chance");
      var zeroChance = $("#container-chance-zero");
      var fiveChance = $("#container-chance-five");
      var tenChance = $("#container-chance-ten");
      var fifChance = $("#container-chance-fif");
      var cost = $("#container-cost");
      chance.on('click', function() {
          if(chance.attr('data-chance') == '0') {
              if(!(cost.attr('data-cost') == 0))
                  cost.html(1 * cost.attr('data-cost') + 15 + " руб.");
              chance.attr('data-chance', '15');
              zeroChance.removeClass('active');
              fiveChance.addClass('active');
              tenChance.removeClass('active');
              fifChance.removeClass('active');
              isActiveBonus=1;
          } else if(chance.attr('data-chance') == '15') {
              if(!(cost.attr('data-cost') == 0))
                  cost.html(1 * cost.attr('data-cost') + 25 + " руб.");
              chance.attr('data-chance', '25');
              zeroChance.removeClass('active');
              fiveChance.removeClass('active');
              tenChance.addClass('active');
              fifChance.removeClass('active');
              isActiveBonus=2;
          } else if(chance.attr('data-chance') == '25') {
              cost.html(1 * cost.attr('data-cost')+ 50 + " руб.");
              chance.attr('data-chance', '50');
              zeroChance.removeClass('active');
              fiveChance.removeClass('active');
              tenChance.removeClass('active');
              fifChance.addClass('active');
              isActiveBonus=3;
          } else if(chance.attr('data-chance') == '50') {
              cost.html(cost.attr('data-cost') + " руб.");
              chance.attr('data-chance', '0');
              zeroChance.addClass('active');
              fiveChance.removeClass('active');
              tenChance.removeClass('active');
              fifChance.removeClass('active');
              isActiveBonus=0;
          }
      });
    }
    if(getCookie('trc')){
      $('.chose_type .type_btn[data-f="'+getCookie('trc')+'"]').addClass('activ');
      if(getCookie('trc')!=="case") $('.item .item_images a').each(function(i) {$(this).attr('href', $(this).attr('href').replace("case", "card"));});
    }else{
      $('.chose_type .type_btn:first').addClass('activ')
    }
    $('.chose_type .type_btn').on('click', function () {
      $('.chose_type .type_btn.activ').removeClass('activ');
      $(this).addClass('activ');
      newType = $(this).data('f');
      setCookie('trc', newType, 30);
      $('.item .item_images a').each(function(i) {
        $(this).attr('href', $(this).attr('href').replace(oldType, newType));
      });
      oldType = newType;
    });
    var ref = getUrlVars()["ref"];
    if (ref == "page") {
        var scrollTop = $('.ceys_title').offset().top;
        $(document).scrollTop(scrollTop);
    }
    ion.sound({
        sounds: [{name: "button_click_on", volume: 0.2}, {name: "snap", volume: 0.2, multiplay: true}, {name: "crash", volume: 0.8}, {name: "dig", volume: 0.8}, {name: "get", volume: 0.5}],
        volume: 0.5,
        path: "/sounds/",
        preload: true
    });
    inprocess = false;
    $('#button_buy').on('click', function () {
        if (inprocess == true)return false; else inprocess = true;
        reach_goal('get_lucky_click');
        window.dataLayer.push({"ecommerce": {"add": {"products": [product]}}});
        ion.sound.play("button_click_on");
        $('#button_buy').addClass('inprocess');
        reloadRulet();
    });
});
var S = 41;
var T = 10;
function processGame() {
    get_random_game(function (err, data) {
        if (err) {
            window.dataLayer.push({"ecommerce": {"remove": {"products": [product]}}});
            console.error(err);
        } else {
            prev = 0;
            spin_sound = setInterval(function () {
                left_pos = (parseInt($('.rulet ul').css('left')) - 500) * -1;
                g_width = $('.rulet ul li').outerWidth() + 20;
                current = Math.floor(left_pos / g_width);
                if (current > prev && current != 2) {
                    ;
                    ion.sound.play("snap");
                    prev = current;
                }
            }, 20);
            widthRulet = ($('.rulet ul li.prize').index() - 2) * ($('.rulet ul li').outerWidth() + 20);
            $('.rulet ul').animate({'left': '-' + (widthRulet - 10) + 'px'}, 1000 * T, 'swing', function () {
                $('#modalWin').arcticmodal();//$('#modal4').arcticmodal();
                $('#button_buy').removeClass('inprocess');
                inprocess = false;
            });
            reach_goal('get_random_game', {order_price: data.price, currency: "RUB"});
            window.dataLayer.push({
                "ecommerce": {
                    "purchase": {
                        "actionField": {
                            "id": data.order_id,
                            "revenue": data.revenue,
                            "goal_id": "29044899"
                        }, "products": [product]
                    }
                }
            });
        }
    });
}
function reloadRulet() {
    if ($('.ceys_full').attr('data-name')) url = '/api/reload?id=' + $('.ceys_full').attr('data-id'); else url = '/api/reload?id=1';
    $.ajax({
        method: 'POST', url: url, success: function (data) {
            $('.rulet ul').css('left', '10px');
            $('.rulet ul').html(data);
            $('.rulet ul').fadeIn(500, function () {
                var number = S;
                $('.rulet ul li:nth-child(' + number + ')').addClass('prize');
                $('.rulet ul').css('min-width', $('.rulet ul li').length * 200);
                setTimeout('processGame()', 1000);
            });
        }
    });
    return true;
}
function get_random_game(cb) {
    $.post('/api/openBox', {
        id: $('.ceys_full').attr('data-id'),
        'b': isActiveBonus
    }).done(function done(data) {
        if (typeof data === 'undefined') {
            console.error('api.php - random_game - result is undefined');
            $('#modal_error_header').text('Не получены данные от сервера');
            $('#modal_error_message').text('Что-то странное происходит');
            $('#modal_error').arcticmodal();
            return cb(new Error('Result is undefined'));
        }
        if (typeof data.error !== 'undefined') {
            console.error('api.php - random_game - error', data.error);
            if (typeof data.error.refill !== 'undefined') {
                $('#refill_rub').html(data.refill);
                $('#refill_input').val(data.refill);
                $('#modal3').arcticmodal();
            } else if (typeof data.error.item_not_found !== 'undefined') {
                $('#modal5').arcticmodal();
            } else {
                $('#modal_error_header').text(data.title);
                $('#modal_error_message').html(data.message);
                $('#modal_error').arcticmodal();
            }
            return cb(new Error(data.error));
        }
        if (typeof data.item === 'undefined') {
            console.error('api.php - random_game - item is not set');
            return cb(new Error('Item is undefined'));
        }
        var item = data.item;
        var img_header = "<img src='" + item.src + "' alt='"
            + item.name + "' style='width: 176px;height: 244px;' /></br></br><h3>" + item.name + "</h3></br>", img_roulette = "<img src='" + item.src + "' alt='" + item.name + "' />";
            
        $('#modalWin .modal-item__image').css('background-image','url('+item.src+')');
        $('#modalWin .modal-title').text(item.name);
        $('#modalWin a.profile-button__text:first').on('click',function(evnt){
          evnt.preventDefault();
          $.ajax({
              method: 'POST', url: '/api/sellItem?id='+data.order_id, success: function (data) {
                if(typeof data.error !== "undefined") {
                  $('#modal_error_header').text('Ошибка');
                  $('#modal_error_message').text(data.message);
                  $('#modal_error').arcticmodal();
                } else {
                  $('#modalWin .modal-info__pass').text(data.info);
                }
              }
          });
        });
        $('#modalWin a.profile-button__text:last').attr('href','/get/'+data.order_id);
        
        /*$('#prizimgpopop').html(img_header);
        $('#modal4 input:first').attr('onClick', 'window.location=\'/get/' + data.order_id + '/\'')
        $('#modal4 input:last').attr('onClick', 'window.location=\'/sell/' + data.order_id + '/\'')*/
        $('.rulet ul li.prize').each(function () {
            $(this).html(img_roulette);
        });
        return cb(null, data);
    }).fail(function fail(jqXHR, textStatus, errorThrown) {
        console.error('api.php - random_game - fail', jqXHR, textStatus, errorThrown);
        $('#modal_error_header').text('Статус №' + textStatus);
        $('#modal_error_message').text('Ошибка обращения к серверу');
        $('#modal_error').arcticmodal();
        return cb(new Error(errorThrown));
    });
}
function modal4() {
    $('#modalWin').arcticmodal();//$('#modal4').arcticmodal();
}
function hideDiv() {
    $('#mailbutton').toggle();
    $('.email').attr('onclick', '');
    $('#inputemail').prop('disabled', false);
}
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
var finslot = false, extra_enabled=false, open_slots=[], slot_compares=0, slot_can, winx;
function get_status(callback){
  var n = "";
  if (open_slots.length>=3 && slot_compares>=3){n="win"}
  else if (!extra_enabled && open_slots.length==3 && slot_compares==2){n="extra_action_selection"}
  else if ((open_slots.length>=5 && slot_compares<3) || finslot){n="win"}
  else if (open_slots.length>=3 && slot_compares<3){n="guaranteed"}
  else {n="basic_slot"}
console.info(n);////////////////////////////////////////////////////////
  return callback({"current_action":n});
}
function extra_action_selection(){
  ion.sound.play("get");
  $('.card-extra').addClass('animate-flicker');
  $('.playcard').addClass('active_arrow_right');
  $(".playcard #case-10").removeClass('off');
  $(".playcard #case-10").wScratchPad("enable", true);
  $('.card-extraerase #possible_item').text(slot_can);
  $('.playcard-inner .card-extraerase').show();
}
function guaranteed(){
  disable_scratch();
  ion.sound.play("fail");
  $('.card-extra').addClass('animate-flicker');
  $('.playcard').addClass('active_arrow_right');
  $(".playcard #case-10").removeClass('off');
  $(".playcard #case-10").wScratchPad("enable", true);
  $('.playcard-teacher3').show();
}
function show_win_dialog(){
  disable_scratch();
  ion.sound.play("get");
  $('.playcard-teacher3').hide();
  $('.playcard-inner .card-extraerase').hide();
  $('.winner-popup .wp-head2 span').text(open_slots[open_slots.length-1]);
  if(open_slots.length>=3 && slot_compares>=3 && !finslot){
    $.ajax({
        method: 'POST', url: '/api/prize?id='+case_id, success: function (data) {
          if(data.message){
            $('#modal_error_header').text(data.message);
            $('#modal_error_message').html('<a class="login arcticmodal-close" style="cursor: pointer">Закрыть</a>');
            $('#modal_error').arcticmodal();
          } else if(typeof data.info!=="undefined" && data.info=="win") {
            fill_others(data.other);
            $('.winner-popup .wp-buttons a:first').attr("href", "/get/"+data.id);
            $('.winner-popup .wp-buttons a:last').attr("href", "/sell/"+data.id);
            $('.winner-popup').show();
          }
        }
    });
  } else {
    $('.winner-popup .wp-buttons a:first').attr("href", "/get/"+winx);
    $('.winner-popup .wp-buttons a:last').attr("href", "/sell/"+winx);
    $('.winner-popup').show();
  }
  $('.winner-popup').addClass("tada animated");
  disable_scratch();
}
function disable_scratch(){
  $(".scratchcases .scratchcase").wScratchPad("enable", false);
}
function start_scratch(){
  $(".scratchcases .scratchcase").wScratchPad("enable", true);
}
function fill_others(cells){
  cells.forEach(function(item){
    var elem = $(".scratchcases .scratchcase[data-id=" + item['n'] + "]");
    elem.addClass("tada animated").wScratchPad("clear");
    elem.find(".item-scratch .picture").html('<img src="' + item['img'] +'">');
  });
}
function open_slot(r){
  elem = $(".scratchcase[data-id=" + r + "]");
  $.ajax({
      method: 'POST', url: '/api/open?id='+case_id+'&num='+r, success: function (data) {
        if(typeof data.error !== "undefined"){
          $('#modal_error #modal_title').text(data.title);
          $('#modal_error_header').html(data.message);
          $('#modal_error_message').html('<a class="login arcticmodal-close" style="cursor: pointer">Закрыть</a>');
          $('#modal_error').arcticmodal();
        } else if(data.message){
          $('#modal_error_header').text(data.message);
          $('#modal_error_message').html('<a class="login arcticmodal-close" style="cursor: pointer">Закрыть</a>');
          $('#modal_error').arcticmodal();
        } else if(typeof data.info!=="undefined" && data.info=="plus") {
          extra_action_selection();
        } else {
          if(typeof data.info!=="undefined" && data.info=="win") {
            winx = data.item;
            fill_others(data.other);
          }
          if (r==10){finslot=true;elem.wScratchPad('clear');}
          open_slots.push(data.name);
            function dubarr(a) {
              var count={}, res=0, q;
              for (q=0; q<a.length; ++q) {
                count[a[q]] = ~~count[a[q]] + 1;
              }
              for (q in count) {
                if (count.hasOwnProperty(q) && count[q] > 1) {
                  slot_can = q;
                  if (res<count[q]) res = count[q];
                }
              }
              return res;
            }
            slot_compares=dubarr(open_slots);
          elem.find(".item-scratch").css('background-image','url("' + data.img +'")');
          elem.find(".item-scratch .descr").html("<strong>" + data.name + "</strong>");
          $('.winner-popup .wp-item img').attr("src", data.img);
        }
        get_status(function(n){
          if (n && n.current_action) switch (n.current_action) {
            case "win":
                return show_win_dialog();
            case "extra_action_selection":
                return extra_action_selection();
            case "guaranteed":
                return guaranteed()
          }
        });
      }
  });
  return elem.attr("data-opened", 1);
}
jQuery(document).ready(function(){
  
    $('.shutupandtakemymoney button').on('click', function(){
      ion.sound.play("click");
      $(this).prop("disabled",true);
      $.ajax({
          method: 'POST', url: '/api/start?id='+case_id, success: function (data) {
            if(typeof data.error !== "undefined"){
              $('#modal_error #modal_title').text(data.title);
              $('#modal_error_header').html(data.message);
              $('#modal_error_message').html('<a class="login arcticmodal-close" style="cursor: pointer">Закрыть</a>');
              $('#modal_error').arcticmodal();
            } else if(data.message){
              $('#modal_error_header').text(data.message);
              $('#modal_error_message').html('<a class="login arcticmodal-close" style="cursor: pointer">Закрыть</a>');
              $('#modal_error').arcticmodal();
            } else {
              $('.shutupandtakemymoney').hide();
              start_scratch();
              //$(".scratchcases .scratchcase").on("click", function(){
                function digCell($elem){
                  opLevel = parseInt($elem.attr('data-op'));
                  if(isNaN(opLevel)){
                    $elem.attr('data-op', 1);
                    $elem.find('.picture').css("background-image", "url(/images/card/d1.png)");
                    ion.sound.play("dig");
                  } else if(opLevel < 10) {
                    $elem.attr('data-op',(++opLevel));
                    $elem.find('.picture').css("background-image", "url(/images/card/d"+opLevel+".png)");
                    ion.sound.play("dig");
                  } else if (opLevel == 10){
                    open_slot($elem.data('id'));
                    ion.sound.play("crash");
                    $elem.find('.picture').css("background-image", "url(/images/card/empty.png)");
                    $elem.addClass("tada animated");
                    $elem.attr('data-op', 99);
                  }
                }
                var timeOut = 0;
                $('.scratchcases .scratchcase').on('mousedown touchstart', function(e) {
                  digCell($(this));
                  timeOut = setInterval(function(ex) {
                    digCell($(ex));
                  }, 300, this);
                }).bind('mouseup mouseleave touchend', function() {
                    clearInterval(timeOut);
                });
            }
          }
      });
    });
    
    $('.card-extraerase button').on('click', function(){
      $(this).prop("disabled",true);
      $('.card-extra').removeClass('animate-flicker');
      $(".playcard #case-10").addClass('off');
      $(".playcard #case-10").wScratchPad("enable", false);
      $.ajax({
          method: 'POST', url: '/api/plus?id='+case_id, success: function (data) {
            if(data.message){
              $('#modal_error_header').text(data.message);
              $('#modal_error_message').html('<a class="login arcticmodal-close" style="cursor: pointer">Закрыть</a>');
              $('#modal_error').arcticmodal();
            } else {
              $('.card-extraerase').hide();
              $('.playcard').toggleClass('active_arrow_right');
              extra_enabled=true;
              console.info(data);
            }
          }
      });
    });
    
    var opLevel;
    $(".scratchcases .scratchcase").on("contextmenu", ".picture", function(t) {
            return !1
        });
    $(".playcard #case-10").wScratchPad({
        size: 25,
        bg: "/images/card/empty.png",
        fg: "/images/card/extra_case.png?2",
        cursor: 'url("/images/card/cursor.png?3") 40 40, default',
        scratchMove: function(t, a) {
            var r = $(".playcard #case-10"), s;
            if ((a > 40 || 3 === t.which || void 0 === t.originalEvent) && (r = $("#case-10"), !(s = r.data("finalized")))) return r.data("finalized", 1), this.clear(), r.addClass("tada animated");
        },
        scratchDown: function(t, a) {
            var r = $(".playcard #case-10"), s;
            if (r.addClass("active_case10"), !(s = r.data("opened")) && open_slot(10) && 3 === t.which) return r.find("canvas").mousemove()
        }
    });
    $("#case-10").on("contextmenu", "canvas", function(t) {
        return !1
    });
    $("#case-10").wScratchPad("enable", false);
    ion.sound({
        sounds: [{name: "crash", volume: 0.8}, {name: "click", volume: 0.3, multiplay: true}, {name: "dig", volume: 0.8, multiplay: true}, {name: "get", volume: 0.5}, {name: "fail", volume: 0.5}],
        volume: 0.5,
        path: "/sounds/",
        preload: true
    });
});
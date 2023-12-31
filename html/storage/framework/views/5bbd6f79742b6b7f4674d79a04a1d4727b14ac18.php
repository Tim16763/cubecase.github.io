<?php $__env->startSection('content'); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
    <div class="ceys_full full">
        <div class="ceys_title"><b>Крафт вещей</b></div>
        <?php if(!$wins->isEmpty()): ?>
        <div class="workbench">
          <table id="xcraft">
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </table>
          <div id="klogo"></div>
          <div id="priceStat">Внесено: <span>0</span> Руб.</div>
          <div id="resultItem"></div>
          <div id="loadBar"></div>
          <div id="craftBtn"></div>
        </div>
        <div style="text-align: center;color: #00e0fd;font-size: 18px;font-weight: 700;line-height: 25px;">
        «Может выпасть от 49 рублей до 9999 рублей»<br>
        Выберите предметы из инвентаря:
        </div>

        <div class="tab-content" id="games" style="width:100%">
            <div class="item_loop2">
                <?php $__currentLoopData = $wins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $win): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="items" data-id="<?php echo e($win->item_id); ?>" data-price="<?php echo e($win->item->sell_price); ?>">
                        <div class="item_images1">
                            <img src="<?php echo e($win->item->img); ?>" alt=""/>
                            <a class="item_open1" style="left: 36px;">Крафт</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php else: ?>
          <div style="text-align: center;color: #00e0fd;font-size: 18px;font-weight: 700;line-height: 25px;">У вас нет вещей для крафта</div>
        <?php endif; ?>
        
<script type="text/javascript">
var craft_arr=[], craft_price=0;

document.addEventListener('DOMContentLoaded', function() {
  $( '.item_loop2' ).on( "click", ".items", function() {
    if(craft_arr.length>=9){
      $('#modal_error_header').text('Ошибка');
      $('#modal_error_message').text('Максимальное количество предметов для крафта 9 (девять)!');
      $('#modal_error').arcticmodal();
    }
    craft_arr.push([$(this).attr('data-id'),$(this).find('img').attr('src'),parseInt($(this).attr('data-price'))]);
    $('table#xcraft td:empty:first').html("<img class='c_elem' data-id='"+$(this).attr('data-id')+"' src='"+$(this).find('img').attr('src')+"'/>");
    craft_price+=parseInt($(this).attr('data-price'));
    $('#priceStat span').text(craft_price);
    $(this).remove();
  });
  
  $( 'table#xcraft' ).on( "click", ".c_elem", function() {
    for(var i=0;i<craft_arr.length;i++){
      if(craft_arr[i][0]==$(this).attr('data-id')){
        $('.item_loop2').append('<div class="items" data-id="'+craft_arr[i][0]+'" data-price="'+craft_arr[i][2]+'"><div class="item_images1"><img src="'+craft_arr[i][1]+'" alt=""/><a class="item_open1" style="left: 36px;">Крафт</a></div></div>');
        craft_price-=craft_arr[i][2];
        craft_arr.splice(i,1);
        break;
      }
    }
    $('#priceStat span').text(craft_price);
    $(this).remove();
  });
  
  $('#craftBtn').on('click',function(){
    if(craft_arr.length<3){
      $('#modal_error_header').text('Ошибка');
      $('#modal_error_message').text('Необходимо выбрать МИНИМУМ 3 (три) предмета!');
      $('#modal_error').arcticmodal();
      return;
    }
    $( "#loadBar" ).animate({width: "119px"},{duration: 1000});
    var toPOST=[];
    for(var i=0;i<craft_arr.length;i++){
      toPOST.push(craft_arr[i][0]);
    }
    $.ajax({
        method: 'POST', url: '/api/craft?items='+JSON.stringify(toPOST), success: function (data) {
            if(data.error){
              $( "#loadBar" ).css("width","0px");
              $('#modal_error_header').text(data.message);
              $('#modal_error_message').html('<a class="login arcticmodal-close" style="cursor: pointer">Закрыть</a>');
              $('#modal_error').arcticmodal(); return;
            }
            craft_arr=[];craft_price=0;
            $('table#xcraft .c_elem').remove();
            $('#resultItem').html("<a href='/get/"+data.order_id+"/'><img src='"+data.img+"'/>");
            $('#priceStat').html("<b>Цена: "+data.price+" Руб!</b>");
        }
    });
  });
}, false);
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
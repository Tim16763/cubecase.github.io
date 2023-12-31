@extends('layout')

@section('content')
<style>
.chose_type {
  margin: 0 auto;
  text-align: center;
}
.type_btn {
    height: 41px;
    line-height: 41px;
    width: 120px;
    display: inline-block;
    text-align: center;
    background: #26bace;
    border-bottom: 3px solid #28a5b1;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
    transition: .5s;
}
.type_btn.activ{
  background: #f36f6f!important;
  border-bottom-color: #9a4646!important;
}
.type_label {
    color: #fff;
    display: inline-block;
    padding: 10px;
    font-weight: bold;
    margin: 0 auto;
    text-transform: uppercase;
}
</style>
    <!--<div class="rulet_full full">
        <div class="rulet_title"><b><em>ВАША ИГРА</em></b> <span><em>испытайте удачу</em></span></div>
        <div class="rulet_btn" id="button_buy"><span>ИСПЫТАТЬ УДАЧУ</span> <b>{{$case->price}} руб.</b></div>
        <div class="rulet_link"><a href="/price/" target="_blank">Что можно выиграть?</a></div>
        <div class="rulet">
            <ul>
                @foreach($items as $item)
                    <li><img src="{{$item->img}}" alt="{{$item->name}}"/></li>
                @endforeach
            </ul>
        </div>
    </div>-->
    <div class="ceys_full full">
    <div class="chose_type">
      <div class="type_label">Тип открытия:</div>
      <div class="type_btn" data-f="case"><span>Рулетка</span></div>
    </div>
		@foreach($category as $cat)
        <div class="ceys_title"><b>{{ $cat->name }}</b></div>
        <div class="item_loop">
            @foreach (\App\Category::getCases($cat->id) as $case1)
            <div class="item" data-id="{{$case1->id}}">
                <div class="fon"></div>
                <div class="border"></div>
                <div class="item_rub">
                @if($case1->oldp > 0)
                  <i>{{$case1->oldp}}</i>
                @endif
                <b>{{$case1->price}}</b> руб
                </div>
                <div class="item_images">
                    <a href="/case/{{$case1->id}}" class="item_open">Открыть</a>
                    <img src="{{$case1->img}}" alt=""/>
                </div>
                <div class="item_text1 ell">{{$case1->name}}</div>
            </div>
            @endforeach
        </div>
		@endforeach
    </div>
    <script type="text/javascript">
        var categoryRulet = "{{$case->name}}";
        var priceRulet = "{{$case->price}}";
    </script>
    
    <div class="social_event">
      <div class="white_bg" style="margin: 12px 0;background:transparent;">
        <div class="social_image">
          <img src="/images/vkrep.png">
        </div>
        <div class="offering-text">
          <p>Получи майнкрафт —<br>бесплатно!</p>
        </div>
        <a href="{{$config->vkgroup}}" class="btn" target="_blank">подробнее<img src="https://i.imgur.com/oa6XSib.png"></a>
      </div>
    </div>
@endsection
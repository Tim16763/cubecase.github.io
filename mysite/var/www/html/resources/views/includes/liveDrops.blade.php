@foreach ($last as $item)
<a class="live-feed__item" href="/user/{{$item->user->id}}/" rel="{{$item->user->name}}" style="background: url({{$item->item->img}}) #3f3a30 center center no-repeat;"><span class="live-feed__item-border"><span class="live-feed__item--hover"><span class="live-feed__item-avatar-border"><span class="live-feed__item-avatar" style="background: url({{$item->user->avatar}}) center center no-repeat;"></span></span><span class="live-feed__item-personaname">{{$item->user->name}}</span></span></span></a>
@endforeach
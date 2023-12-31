@extends('layout')

@section('content')
    <link rel="stylesheet" type="text/css" href="/css/lk_style.css?3">
    <style>
.profile {
    display: block;
}.profile-left {
    float: left;
    width: 298px;
}.profile-personaname {
    display: block;
    color: #fff;
    font-size: 21px;
    text-align: center;
    width: 204px;
    margin: 0 auto;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    text-decoration: none;
}.profile-avatar {
    display: block;
    background: url(/images/profile-avatar.png) 0 0;
    width: 139px;
    height: 196px;
    margin: 15px auto;
}.profile-avatar__image {
    display: block;
    width: 101px;
    height: 101px;
    background-size: 101px auto!important;
    border: 2px solid #6699b5;
    border-radius: 5px;
    position: relative;
    margin: 0 auto;
    top: 32px;
}.profile-button, .profile-button__text {
    display: block;
    width: 204px;
    height: 67px;
    text-decoration: none!important;
    color: #fff!important;
}.profile-button {
    background: url(/images/modal-button.png) 0 0;
    font-size: 16px;
    text-transform: uppercase;
}.profile-left__profile-button {
    margin: 5px auto 0;
}.profile-button:not(:hover) .profile-button--hover {
    opacity: 0;
    transition: opacity .5s ease;
}.profile-button--hover {
    display: block;
    background: url(/images/modal-button.png) 0 67px;
    width: 204px;
    height: 67px;
}.profile-button__text {
    position: relative;
    top: -67px;
    text-align: center;
    line-height: 69px;
}.profile-right {
    float: right;
    width: calc(100% - 302px);
    position: relative;
    top: -14px;
}.clear {
    clear: both;
}#profileItems {
    width: 900px;
    height: 1150px;
    overflow: auto;
    position: inherit;
    margin: 0 auto 25px;
    padding: 20px;
    left: 10%;
    margin-right: -15%;
}.items {
    text-align: center;
}.item--common {
    background: url(/images/item--common.png) #49bffc 0 0 no-repeat;
}.item {
    display: inline-block;
    width: 139px;
    height: 190px;
    margin: 0 20px 20px 0;
    cursor: pointer;
    text-decoration: none!important;
}.item__image, .item__title {
    width: 130px;
    position: relative;
}.item__image {
    height: 183px;
    background-size: 130px auto!important;
    top: 3px;
    left: 4px;
}.item__title {
    display: block;
    background: #528a80;
    opacity: .86;
    bottom: 33px;
    margin-left: 4px;
    height: 35px;
    line-height: 35px;
    color: #fff;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
    </style>
    <center>
<div class="ceys_full full lk-content" style="font-family: Open Sans;">
<div class="category">Профиль</div>
<div class="profile">
<div class="profile-left">
<a class="profile-personaname" rel="{{$user->name}}">{{$user->name}}</a>
<a class="profile-avatar" rel="{{$user->name}}">
<span class="profile-avatar__image" style="background: url('{{$user->avatar}}') center center no-repeat;"></span>
</a>
<span style="color:#fff;font-size:21px;display:block;">#{{$user->id}}<span>
@if($user->h)
<span style="color:#fff;font-size:21px;display:block;">Пользователь скрыл ссылку на профиль<span>
@else
<a class="profile-button profile-left__profile-button" target="_blank" href="https://vk.com/id{{$user->user_id}}" rel="Профиль">
<span class="profile-button--hover"></span>
<span class="profile-button__text">Страница VK</span>
</a>
@endif
</div>
<div class="profile-right"></div>
<div class="clear"></div>
</div>
<div class="category">Список игр</div>
<div class="items" id="profileItems">
@foreach ($wins as $win)
<div class="item item--common">
<div class="item__image" style="background: url('{{$win->item->img}}') center center no-repeat;"></div>
<div class="item__title">{{$win->item->name}}</div>
</div>
@endforeach
</div>
        </div>
    </center>
@endsection
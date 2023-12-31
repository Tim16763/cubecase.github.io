<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');
Route::get('/case/{id}', 'PagesController@cases');
Route::get('/price', 'PagesController@price');
Route::get('/logout', 'AuthController@logout');
Route::get('/feedback', 'PagesController@feedback');
Route::get('/faq', 'PagesController@faq');
Route::get('/garant', 'PagesController@garant');
Route::get('/user/{id}', 'PagesController@user');

Route::group(['prefix' => '/api'], function () {
    Route::get('/stackFake', 'ApiController@stackFake');
    Route::post('/promocodeUse', 'ApiController@promocodeUse');
    Route::post('/getStats', 'ApiController@getStats');
    Route::post('/reload', 'ApiController@reload');
    Route::post('/open', 'CardController@open');
    Route::post('/start', 'CardController@start');
    Route::post('/prize', 'CardController@prize');
    Route::post('/plus', 'CardController@plus');
    Route::post('/openBox', 'ApiController@openBox');
    Route::post('/profile', 'ApiController@profile');
    Route::post('/sellItem', 'ApiController@sellItem');
    Route::post('/payment/create', 'ApiController@createPayment');
    Route::get('/payment/digiseller', 'ApiController@digiseller');
    Route::post('/payment/sauldebil', 'ApiController@sauldebil');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/oplata', 'PagesController@oplata');
    Route::get('/account', 'PagesController@account');
    Route::get('/get/{id}', 'PagesController@get');
    Route::get('/sell/{id}', 'PagesController@sell');
});

Route::group(['prefix' => '/auth'], function () {
    Route::get('/{provider}', 'AuthController@login');
    Route::get('/callback/{provider}', 'AuthController@callback');
});

Route::group(['prefix' => '/admin', 'middleware' => 'Access:admin'], function() {
    Route::get('/', 'AdminController@index');
    Route::get('/settings', 'AdminController@settings');
    Route::get('/saveSettings', 'AdminController@saveSettings');
    Route::get('/lastOpen', 'AdminController@lastOpen');
    Route::get('/lastWithdraw', 'AdminController@lastWithdraw');
    Route::get('/users', 'AdminController@users');
    Route::get('/user/{id}', 'AdminController@user');
    Route::get('/saveUser', 'AdminController@saveUser');
    Route::get('/cases', 'AdminController@cases');
    Route::get('/case/{id}', 'AdminController@casee');
    Route::get('/saveCase', 'AdminController@saveCase');
    Route::get('/addCase', 'AdminController@addCase');
    Route::get('/addCasePost', 'AdminController@addCasePost');
    Route::get('/addItem', 'AdminController@addItem');
    Route::get('/addItemPost', 'AdminController@addItemPost');
    Route::get('/item/{id}', 'AdminController@item');
    Route::get('/saveItem', 'AdminController@saveItem');
    Route::get('/addUser', 'AdminController@addUser');
    Route::get('/addUserPost', 'AdminController@addUserPost');
    Route::get('/items', 'AdminController@items');
    Route::get('/crafts', 'AdminController@crafts');
    Route::get('/acceptWithdraw/{id}', 'AdminController@acceptWithdraw');
    Route::get('/declineWithdraw/{id}', 'AdminController@declineWithdraw');
    Route::get('/lastOrders', 'AdminController@lastOrders');
    Route::get('/promocode', 'AdminController@promocode');
    Route::get('/addCode', 'AdminController@addCode');
    Route::get('/addCodePost', 'AdminController@addCodePost');
	Route::get('/category', 'AdminController@category');
	Route::get('/addCategory', 'AdminController@addCategory');
	Route::get('/addCategoryPost', 'AdminController@addCategoryPost');
	Route::get('/categorye/{id}', 'AdminController@categorye');
	Route::get('/saveCategory', 'AdminController@saveCategory');
});
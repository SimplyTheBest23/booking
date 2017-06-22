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

Route::get('/', 'HomeController@index');
Route::post('/sms/smssend', 'SmsController@smsSend');
Route::post('/sms/smsget', 'SmsController@smsGet');
Route::post('/sms/smssendcode', 'SmsController@smsSendCode');
Route::post('/test', 'MainController@testPost')->name('test');
Route::get('/test', 'MainController@testGet')->name('test');
Route::post('/main/checkcode', 'MainController@checkCode');
Route::post('/main/setcode', 'MainController@setCode');
Route::post('/main/addphoto', 'MainController@addphoto');
Route::post('/main/selectcitymap', 'MainController@selectCityMap');
Route::post('/main/getbeach', 'MainController@getBeach');
Route::post('/main/publishhotel', 'MainController@publishHotel');
Route::resource('hotel','HotelsController');
Route::get('/rooms/{id}', 'RoomsController@roomsList');
Route::post('/rooms/getlist', 'RoomsController@getlist');
Route::get('/room/{id}', 'RoomsController@show');
Route::post('/room/paggination', 'RoomsController@paggination');
Route::post('/room/save', 'RoomsController@update');
Route::post('/hotel/paggination', 'HotelsController@paggination');
Route::post('/main/login', 'MainController@login');
Route::post('/main/putfeed', 'MainController@putFeed');
Route::post('/feeds/getlist', 'MainController@feedsList');
Route::post('/feeds/save', 'MainController@feedsSave');
Route::post('/feeds/re', 'MainController@feedsRe');
Route::post('getbook', 'RoomsController@getBook');
Route::group(['middleware'=>'CheckLogin'],function(){// only register users
    Route::get('/cabinet', 'MainController@cabinet');
    Route::get('/hotel/{hotel}/feeds', 'HotelsController@feeds');
    Route::get('/roomsedit/{id}', 'RoomsController@edit');
    Route::get('hotel/{hotel}/edit', 'HotelsController@edit');
    Route::post('changeuserdata', 'MainController@saveUserData');
    Route::post('setbook', 'RoomsController@setBook');
});
//admin
Route::get('admin', 'AdminController@index');
Route::get('admin/statistic', 'AdminController@statistic');
Route::get('admin/hotels', 'AdminController@hotels');
Route::get('admin/pays', 'AdminController@pays');
Route::get('admin/paidservices', 'AdminController@paidservices');
Route::get('admin/features', 'AdminController@features');
Route::get('admin/sms', 'AdminController@sms');
Route::get('admin/cities', 'AdminController@cities');
Route::get('admin/other', 'AdminController@other');
Route::post('admin/hotelinfo', 'AdminController@hotelinfo');
Route::post('admin/roomsinfo', 'AdminController@roomsinfo');
//end edmin

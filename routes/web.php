<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Package Routes
|--------------------------------------------------------------------------
*/
Route::get('wechat', ['as' => 'verify', 'uses' => 'WechatController@verify']);
Route::post('wechat', ['as' => 'user_request', 'uses' => 'WechatController@serve']);
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', [
    'as' => 'home', 'uses' => 'HomeController@index'
]);

Route::post('/register', [
    'as' => 'register', 'uses' => 'Auth\AuthController@register'
]);

Route::post('/login', [
    'as' => 'login', 'uses' => 'Auth\AuthController@login'
]);

Route::get('room', [
    'as' => 'room', 'uses' => 'RoomController@joinRoom'
]);

Route::get('room/private', [
    'as' => 'room/private', 'uses' => 'RoomController@createPrivateRoom'
]);


Route::get('room/{slug}', [
    'as' => 'room/{slug}', 'uses' => 'RoomController@play'
]);

Route::get('room/{slug}/profile', [
    'as' => 'room/{slug}/profile', 'uses' => 'RoomController@profile'
]);

Route::get('profile/{name}', [
    'as' => 'profile', 'uses' => 'ProfileController@details'
]);

Route::get('rank', [
    'as' => 'rank', 'uses' => 'RankController@listage'
]);


Route::get('credit', [
    'as' => 'credit', 'uses' => 'CreditController@show'
]);
Route::auth();

Route::get('/home', 'HomeController@index');

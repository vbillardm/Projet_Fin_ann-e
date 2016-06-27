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

Route::get('home', 'HomeController@index');

Route::auth();

Route::post('register', [
    'as' => 'register', 'uses' => 'Auth\AuthController@register'
]);

Route::post('login', [
    'as' => 'login', 'uses' => 'Auth\AuthController@login'
]);

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('room', [
        'as' => 'room', 'uses' => 'RoomController@joinRoom'
    ]);

    Route::get('room/private/create', [
        'as' => 'form-private', 'uses' => 'RoomController@formPrivateRoom' // *
    ]);
    
    Route::post('room/private/create', [
        'as' => 'create-private', 'uses' => 'RoomController@createPrivateRoom'
    ]);
    
    Route::get('room/private/join', [
        'as' => 'join-private', 'uses' => 'RoomController@joinPrivateRoom'
    ]);

    Route::post('room/private/select/', [
        'as' => 'select-private', 'uses' => 'RoomController@selectPrivateRoom' // * méthode en minuscule
    ]);
    
    Route::post('room/private/{slug}', [
        'as' => 'room-private', 'uses' => 'RoomController@selectedPrivateRoom' // * méthode en minuscule
    ]);

    Route::get('room/public/{slug}', [
        'as' => 'room-public', 'uses' => 'RoomController@selectedPublicRoom' // * nouvelle méthode
    ]);
    
    Route::post('room/public/select', [
        'as' => 'select-public', 'uses' => 'RoomController@play'
    ]);

    Route::get('room/profile/{slug}', [
        'as' => 'room-profile', 'uses' => 'RoomController@profile'
    ]);

    Route::get('profile/{name}', [
        'as' => 'profile', 'uses' => 'ProfileController@details'
    ]);
    
    Route::get('rank', [
        'as' => 'rank', 'uses' => 'RankController@rankingList'
    ]);
    
    Route::get('credit', [
        'as' => 'credit', 'uses' => 'CreditController@show'
    ]);
});

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

Route::get('/', [ 'uses' => 'HomeController@index',
 'as' => 'home'] );

// Authentication routes...
Route::get('login', ['uses' => 'Auth\AuthController@getLogin',
 'as' => 'login']);

Route::post('login', ['uses' => 'Auth\AuthController@postLogin',
'as' => 'login']);

Route::get('logout', [ 'uses' => 'Auth\AuthController@getLogout',
'as' => 'logout']);

//CONTACT....
Route::get('contact', [ 'uses' => 'ContactController@index',
    'as' => 'contact'] );

Route::resource('mail', 'ContactController');


//SETTINGS....
Route::get('settings', [ 'uses' => 'UserController@settings',
    'as' => 'settings'] );

Route::put('updateroute/{id}', [ 'uses' => 'SettingsController@update',
    'as' => 'updateroute'] );


Route::post('storage/create', [ 'uses' => 'StorageController@save',
    'as' =>'storage/create']);

/*Route::post('settings', [ 'uses' => 'UserController@update',
    'as' => 'settings'] );*/

//USERMAIN...
Route::get('usermain', [ 'uses' => 'UserController@index',
    'as' => 'usermain'] );

Route::get('showpictures', [ 'uses' => 'StorageController@show',
    'as' => 'showpictures'] );

Route::get('showmap', [ 'uses' => 'StorageController@showmap1',
    'as' => 'showmap'] );

Route::delete('deletepictures/{picture}', [ 'uses' => 'StorageController@delete',
    'as' => 'deletepictures'] );

// Registration routes...
Route::get('register', ['uses' => 'Auth\AuthController@getRegister',
'as' => 'register']);
Route::post('register', ['uses' => 'Auth\AuthController@postRegister',
'as' => 'register']);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::controllers([
    'auth' => '\App\Http\Controllers\Auth\AuthController',
    'password' => '\App\Http\Controllers\Auth\PasswordController',
]);
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
/*
//CONTACT....
Route::post('contactsend', [ 'uses' => 'ContactController@store',
    'as' => 'contactsend'] );*/

Route::resource('mail', 'ContactController');


//SETTINGS....
Route::get('settings', [ 'uses' => 'UserController@settings',
    'as' => 'settings'] );

Route::put('updateroute/{id}', [ 'uses' => 'UserController@update',
    'as' => 'updateroute'] );


/*Route::post('settings', [ 'uses' => 'UserController@update',
    'as' => 'settings'] );*/

//USERMAIN...
Route::get('usermain', [ 'uses' => 'UserController@index',
    'as' => 'usermain'] );


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
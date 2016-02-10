<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

/*
	api
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->post('signin', 'App\Http\Controllers\Api\V1\AuthController@authenticate');
});

$api->version('v1', function ($api) {
    $api->post('signup', 'App\Http\Controllers\Api\V1\AuthController@store');
});

$api->version('v1', ['middleware' => 'jwt.auth'], function ($api) {
    $api->resource('post', 'App\Http\Controllers\Api\V1\PostController');
    /*
		refreshing user token
    */
    $api->get('refresh', 'App\Http\Controllers\Api\V1\AuthController@refresh');
});

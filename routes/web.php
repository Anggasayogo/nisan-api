<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/key',function(){
    return \Illuminate\Support\Str::random(32);
});

$router->post('/login','AuthController@login');
$router->post('/register','AuthController@register');

$router->group(['prefix' => 'api/v1/','middleware' => 'auth','middleware' => 'cors'], function () use ($router) {
    $router->get('/user/{id}','UserController@index');
    // members
    $router->get('/member','MemberController@index');
    $router->get('/member/{id}','MemberController@index');
    $router->post('add/member','MemberController@store');
    $router->post('update/member/{id}','MemberController@update');
    $router->get('delete/member/{id}','MemberController@destroy');

    // kopdar
    $router->get('/kopdar','KopdarController@index');
    $router->get('/kopdar/{id}','KopdarController@index');
    $router->post('add/kopdar','KopdarController@store');
    $router->post('update/kopdar/{id}','KopdarController@update');
    $router->get('delete/kopdar/{id}','KopdarController@destroy');
});


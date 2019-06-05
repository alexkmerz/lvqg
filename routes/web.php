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

$router->post('/login', 'UserController@login');
$router->post('/register', 'UserController@register');

$router->group(['prefix' => 'api', 'middleware' => 'jwt.auth'], function ($router) {
    $router->get('/hello', 'HomeController@show');
});

$router->get('/{route:.*}/', function ()  {
    return view('app');
});

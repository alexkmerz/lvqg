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
$router->post('/clone', 'RepositoryController@clone');


$router->group(['prefix' => 'api', 'middleware' => 'jwt.auth'], function ($router) {
    /**
     * Repository management routes
     */
    $router->group(['prefix' => 'repository'], function ($router) {
        $router->get('/', 'RepositoryController@index');
        $router->get('/{id}', 'RepositoryController@getRepositoryStructure');

        $router->post('/clone', 'RepositoryController@clone');
    });
});

$router->get('{route:.*}', function ()  {
    return view('app');
});

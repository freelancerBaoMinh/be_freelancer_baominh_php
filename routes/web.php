<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return 'success';
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix'=>'auth'], function () use ($router){
        $router->post('login', 'Api\Customer\LoginController@login');
    });
    $router->group(['middleware'=>'jwt.auth'], function () use ($router){
        $router->post('user/logout', 'Api\Customer\LoginController@logout');
    });
});

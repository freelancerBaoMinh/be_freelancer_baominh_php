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
        $router->group(['prefix'=>'user'], function () use ($router){
            $router->post('logout', 'Api\Customer\LoginController@logout');
            $router->post('change-password', 'Api\Customer\UserController@changePass');
        });
        $router->group(['prefix'=>'compensation'], function () use ($router){
            $router->post('request', 'Api\Customer\CompensationController@store');
            $router->get('history', 'Api\Customer\CompensationController@list');
        });
        $router->group(['prefix'=>'admin', 'middleware'=>'admin'], function () use ($router){
            $router->get('list-package', 'Api\Admin\HomeController@listPackage');
            $router->get('detail-package', 'Api\Admin\HomeController@detailPackage');
            $router->get('list-benefit', 'Api\Admin\HomeController@listRule');
            $router->post('create-package', 'Api\Admin\HomeController@createPackage');
            $router->post('delete-package', 'Api\Admin\HomeController@deletePackage');
            $router->get('list-contract', 'Api\Admin\HomeController@listContract');
            $router->post('delete-contract', 'Api\Admin\HomeController@deleteContract');
            $router->post('update-contract', 'Api\Admin\HomeController@updateContract');
            $router->post('list-account', 'Api\Admin\HomeController@listAccount');
            $router->post('create-account', 'Api\Admin\HomeController@createAccount');
            $router->post('update-account', 'Api\Admin\HomeController@updateAccount');
            $router->post('delete-account', 'Api\Admin\HomeController@deleteAccount');
            $router->post('accept-compensation', 'Api\Admin\HomeController@accept');
            $router->post('cancel-compensation', 'Api\Admin\HomeController@cancel');
            $router->get('list-compensation', 'Api\Admin\HomeController@listCompensation');
        });
    });
});

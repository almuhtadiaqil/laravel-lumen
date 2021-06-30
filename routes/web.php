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
    return $router->app->version();
});

// generate application key
$router->get('/key', 'ExampleController@generateKey');
// 
$router->post('/foo', 'ExampleController@fooExample');

// router parameter
$router->get('/user/{id}', 'ExampleController@getUser');
$router->get('/post/cat1/{cat1}/cat2/{cat2}', 'ExampleController@getPost');

// Optional route parameter
$router->get('/optional[/{param}]', function ($param = null) {
    return $param;
});

// aliases route
$router->get('profile', ['as' => 'profile', 'uses' => 'ExampleController@getProfile']);
$router->get('/profile/action', ['as' => 'profile.action', 'uses' => 'ExampleController@profileAction']);

// group route
$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->get('home', function () {
        return 'Home admin';
    });
    $router->get('profile', function () {
        return 'Profile admin';
    });
});
// middleware
$router->get('/admin/home', ['middleware' => 'age', function () {
    return 'Old Enough';
}]);

$router->get('/foo/bar', 'ExampleController@fooBar');
$router->post('/bar/foo', 'ExampleController@fooBar');

$router->post('/user/profile/request', 'ExampleController@userProfile');
$router->get('/fail', function () {
    return 'Not yet mature';
});

$router->get('/response', 'ExampleController@response');

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/user/{id}', 'UserController@show');

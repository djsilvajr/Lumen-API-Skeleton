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


//Rotas de autenticação
$router->post('/api/login', 'AuthController@login');
$router->get('/api/usuario', ['middleware' => 'auth', 'uses' => 'AuthController@usuario']);
$router->get('/api/usuario/{id}', ['middleware' => 'auth', 'uses' => 'AuthController@usuarioId']);
$router->post('/api/logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout']);

//Timeout (Não funcional)
$router->get('/timeout/limiteExcedido',['middleware' => ['auth', 'timeout'], 'uses' => 'TimeoutController@limiteExcedido']);
$router->get('/timeout/limiteOk',['middleware' => ['auth', 'timeout'], 'uses' => 'TimeoutController@limiteOk']);

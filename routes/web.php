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


$router->group(['prefix' => 'api/v1', 'namespace' => 'v1'], function () use ($router) {

    /**
     * CRUDS alertes
     */
    $router->group(['prefix' => 'alertes'], function () use ($router) {
        $router->get('/', ['uses' => 'AlerteController@index']);
        $router->post('/', ['uses' => 'AlerteController@store']);
        $router->post('/info/{user_id}', ['uses' => 'AlerteController@historyInfoUserAlert']);
        $router->patch('/{alerte}/subscribe', ['uses' => 'AlerteController@subScribeAlerte']);

    });

    $router->get('/specialities', ['uses' => 'SpecialityController@index']);

});

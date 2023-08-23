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
        $router->get('/info/{user_id}', ['uses' => 'AlerteController@historyInfoUserAlert']);
        $router->patch('/{alerte}/subscribe', ['uses' => 'AlerteController@subScribeAlerte']);
    });


    /**
     * CRUDS etablissements
     */
    $router->group(['prefix' => 'etablissements'], function () use ($router) {
        $router->get('/', ['uses' => 'EtablissementController@index']);
        $router->post('/', ['uses' => 'EtablissementController@store']);
        $router->get('/{etablissement_id}', ['uses' => 'EtablissementController@show']);
        $router->get('/user/{user_id}', ['uses' => 'EtablissementController@showEtabliseementUser']);
        $router->get('/{etablissement_id}/alerte', ['uses' => 'EtablissementController@showAlertEtablissement']);
        $router->get('/{etablissement_id}/mail', ['uses' => 'EtablissementController@sendActivationMailEtablissement']);
        $router->patch('/{etablissement_id}/state', ['uses' => 'EtablissementController@stateEtablissement']);
        $router->patch(
            '/{etablissement_id}/speciality/remove',
            ['uses' => 'EtablissementController@removeEtablissmentSpeciality']
        );
        $router->patch('/{etablissement_id}/update', ['uses' => 'EtablissementController@updateEtablissement']);
        $router->patch('/{etablissement_id}/speciality/add', ['uses' => 'EtablissementController@updateSpeciality']);
        $router->patch('/{agenda_id}/agenda/update', ['uses' => 'EtablissementController@updateAgenda']);



        $router->post('/{etablissement_id}/store_image', ['uses' => 'EtablissementController@storeImageEtablissement']);
    });
    /**
     * list specialite
     */
    $router->get('/specialities', ['uses' => 'SpecialityController@index']);
});

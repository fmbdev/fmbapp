<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

$router->group(['prefix' => 'api'], function() use ($router){

    /*--- Campus Route ---*/
    $router->get('/campus', [
        'uses'  => 'Campus\CampusController@getAll'
    ]);

    /*--- Nivel Route ---*/
    $router->get('/nivel', [
        'uses'  => 'Nivel\NivelController@getAll'
    ]);

    /*--- Modalidad Route ---*/
    $router->get('/modalidad', [
        'uses'  => 'Modalidad\ModalidadController@getAll'
    ]);

    /*--- Carrera Route ---*/
    $router->get('/carrera', [
        'uses'  => 'Carrera\CarreraController@getAll'
    ]);

    /*--- Ciclo Route ---*/
    $router->get('/ciclo', [
        'uses'  => 'Ciclo\CicloController@getAll'
    ]);


});
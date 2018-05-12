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

$router->group(['prefix' => 'api'], function() use ($router){

    /*--- Asesor Cita ---*/
    $router->get('/asesor', [
        'uses'  => 'Asesor\AsesorController@getAll'
    ]);

    /*--- Campus Route ---*/
    $router->get('/campus', [
        'uses'  => 'Campus\CampusController@getAll'
    ]);

    /*--- CampusCita Route ---*/
    $router->get('/campus_cita', [
        'uses'  => 'CampusCita\CampusCitaController@getAll'
    ]);

    /*--- Canales Route ---*/
    $router->get('/canales', [
        'uses'  => 'Canales\CanalesController@getAll'
    ]);

    /*--- Carrera Route ---*/
    $router->get('/carrera', [
        'uses'  => 'Carrera\CarreraController@getAll'
    ]);

    /*--- Ciclo Route ---*/
    $router->get('/ciclo', [
        'uses'  => 'Ciclo\CicloController@getAll'
    ]);

    /*--- Cita Prospeccion Route ---*/
    $router->get('/cita_prospeccion', [
        'uses'  => 'CitaProspeccion\CitaProspeccionController@getAll'
    ]);

    /*--- Csq Route ---*/
    $router->get('/csq', [
        'uses'  => 'Csq\CsqController@getAll'
    ]);

    /*--- Escuela Empresa Route ---*/
    $router->get('/escuela_empresa', [
        'uses'  => 'EscuelaEmpresa\EscuelaEmpresaController@getAll'
    ]);

    /*--- Genero Route ---*/
    $router->get('/genero', [
        'uses'  => 'Genero\GeneroController@getAll'
    ]);

    /*--- Modalidad Route ---*/
    $router->get('/modalidad', [
        'uses'  => 'Modalidad\ModalidadController@getAll'
    ]);

    /*--- Nivel de Estudios Route ---*/
    $router->get('/nivel_estudios', [
        'uses'  => 'Nivel\NivelController@getAll'
    ]);

    /*--- Paginas Landing Route ---*/
    $router->get('/paginas_landing', [
        'uses'  => 'PaginasLanding\PaginasLandingController@getAll'
    ]);

    /*--- Parentesco Route ---*/
    $router->get('/parentesco', [
        'uses'  => 'Parentesco\ParentescoController@getAll'
    ]);

    /*--- Programacion Route ---*/
    $router->get('/programacion', [
        'uses'  => 'Programacion\ProgramacionController@getAll'
    ]);

    /*--- Palabras Basura Route ---*/
    $router->get('/palabras_basura', [
        'uses'  => 'PalabrasBasura\PalabrasBasuraController@getAll'
    ]);

    $router->get('/palabras_basura/{id}', [
        'uses'  => 'PalabrasBasura\PalabrasBasuraController@show'
    ]);

    /*--- Sin Correo Route ---*/
    $router->get('/sin_correo', [
        'uses'  => 'SinCorreo\SinCorreoController@getAll'
    ]);

    /*--- Sub Tipo Actividad Route ---*/
    $router->get('/subsubtipo_actividad', [
        'uses'  => 'SubSubTipoActividad\SubSubTipoActividadController@getAll'
    ]);

    /*--- Territorio Route ---*/
    $router->get('/territorio', [
        'uses'  => 'Territorio\TerritorioController@getAll'
    ]);

    /*--- Tipificacion Route ---*/
    $router->get('/tipificacion', [
        'uses'  => 'Tipificacion\TipificacionController@getAll'
    ]);

    /*--- Tipo de Actividad Route ---*/
    $router->get('/tipo_actividad', [
        'uses'  => 'TipoActividad\TipoActividadController@getAll'
    ]);

    /*--- Tipo de Referente Route ---*/
    $router->get('/tipo_referente', [
        'uses'  => 'TipoReferente\TipoReferenteController@getAll'
    ]);

    /*--- Transferencia Route ---*/
    $router->get('/transferencia', [
        'uses'  => 'Transferencia\TransferenciaController@getAll'
    ]);

    /*--- Turno Route ---*/
    $router->get('/turno', [
        'uses'  => 'Turno\TurnoController@getAll'
    ]);

    /*--- Usuarios Route ---*/
    $router->get('/usuario', [
        'uses'  => 'Usuario\UsuarioController@getAll'
    ]);

    /*--- Area Interes Route ---*/
    $router->get('/area_interes', [
        'uses'  => 'AreaInteres\AreaInteresController@getAll'
    ]);

    /*--- CampusNivel Interes Route ---*/
    $router->get('/campus_nivel', [
        'uses' => 'CampusNivel\CampusNivelController@getAll'
    ]);

    /*--- Carreras by campus Route ---*/
    $router->get('/campus_carreras', [
        'uses'  => 'Carrera\CarreraController@getCampusCarreras'
    ]);

     /*--- Actividad Agenda Route ---*/
     $router->get('/actividad_agenda', [
         'uses' => 'ActividadAgenda\ActividadAgendaController@getAll'
     ]);



    /*--- Web Service ---*/
    $router->get('/landing', [
        'uses'  => 'WebService\UserController@getCars'
    ]);

    $router->post('/landing/valid-input', [
        'uses'  => 'WebService\UserController@landingValidNameAction'
    ]);

    $router->post('/landing/login', [
        'uses'  => 'WebService\UserController@landingLoginAction'
    ]);

    $router->post('/landing/register', [
        'uses'  => 'WebService\UserController@landingRegisterAction'
    ]);
    
    $router->post('/landing/register-promotion', [
        'uses'  => 'WebService\UserController@landingRegisterPromotionAction'
    ]);

    $router->post('/landing/register-solo', [
        'uses'  => 'WebService\UserController@landingRegisterSoloAction'
    ]);

    $router->post('/landing/referido-referente', [
        'uses'  => 'WebService\UserController@landingReferidoReferenteAction'
    ]);

    $router->post('/landing/referido-web', [
        'uses'  => 'WebService\UserController@landingReferidoReferenteWebAction'
    ]);

    $router->post('/landing/search', [
        'uses'  => 'WebService\UserController@landingSearchAction'
    ]);
    $router->post('/landing/search-inbound', [
        'uses'  => 'WebService\UserController@landingSearchAInboundction'
    ]);

    /*--- Import CSV ---
    $router->get('/pnn', [
        'uses' => 'Pnn\PnnController@getAll'
    ]);*/

    $router->get('/getToken', [
        'uses'  => 'WebService\RolController@getToken'
    ]);

    $router->get('/roles/{user_id}', [
        'uses'  => 'WebService\RolController@getRoles'
    ]);

});
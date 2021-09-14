<?php

use App\Http\Controllers\PerpusController;



$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/perpus', 'PerpusController@index');
$router->post('/perpus', 'PerpusController@store');
$router->get('/perpus/{id}', 'PerpusController@show');
$router->put('/perpus/{id}', 'PerpusController@update');
$router->delete('/perpus/{id}', 'PerpusController@destroy');

<?php

$router->get('/', function () use ($router) {
    return ['name' => 'Lumen API', 'version' => '1.0.0', 'status' => 'ok'];
});

$router->get('/health', function () use ($router) {
    return ['status' => 'ok', 'service' => 'lumen'];
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->post('/auth/register', 'Api\V1\AuthController@register');
    $router->post('/auth/login', 'Api\V1\AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/auth/refresh', 'Api\V1\AuthController@refresh');
        $router->post('/auth/logout', 'Api\V1\AuthController@logout');
        $router->get('/auth/me', 'Api\V1\AuthController@me');
    });
});
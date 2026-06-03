<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

$app->router->get('/', fn() => ['name' => 'Lumen API', 'version' => '1.0.0', 'status' => 'ok']);
$app->router->get('/health', fn() => ['status' => 'ok', 'service' => 'lumen']);
$app->router->post('/api/v1/auth/register', 'App\Http\Controllers\Api\V1\AuthController@register');
$app->router->post('/api/v1/auth/login', 'App\Http\Controllers\Api\V1\AuthController@login');

$app->router->group(['middleware' => \App\Http\Middleware\Authenticate::class], function ($router) {
    $router->post('/api/v1/auth/refresh', 'App\Http\Controllers\Api\V1\AuthController@refresh');
    $router->post('/api/v1/auth/logout', 'App\Http\Controllers\Api\V1\AuthController@logout');
    $router->get('/api/v1/auth/me', 'App\Http\Controllers\Api\V1\AuthController@me');
});

$app->run();
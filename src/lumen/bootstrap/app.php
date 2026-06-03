<?php

require_once __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;

$app = new Laravel\Lumen\Application(dirname(__DIR__));

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$app->configure('database');
$app->configure('auth');

$app->make('config')->set('jwt', [
    'secret' => env('JWT_SECRET'),
    'keys' => [
        'public' => env('JWT_PUBLIC_KEY'),
        'private' => env('JWT_PRIVATE_KEY'),
        'passphrase' => env('JWT_PASSPHRASE'),
    ],
    'ttl' => (int) env('JWT_TTL', 60),
    'refresh_ttl' => (int) env('JWT_REFRESH_TTL', 20160),
    'algo' => env('JWT_ALGO', 'HS256'),
    'required_claims' => [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti',
    ],
    'persistent_claims' => [],
    'lock_subject' => true,
    'leeway' => (int) env('JWT_LEEWAY', 0),
    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', false),
    'blacklist_grace_period' => (int) env('JWT_BLACKLIST_GRACE_PERIOD', 0),
    'decrypt_cookies' => false,
    'providers' => [
        'jwt' => Tymon\JWTAuth\Providers\JWT\Lcobucci::class,
        'auth' => Tymon\JWTAuth\Providers\Auth\Illuminate::class,
        'storage' => Tymon\JWTAuth\Providers\Storage\Illuminate::class,
    ],
]);

$app->register(\Tymon\JWTAuth\Providers\LumenServiceProvider::class);

$app->withFacades();
$app->withEloquent();

return $app;
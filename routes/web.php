<?php

$router->get('/', function () use ($router) {
    return response()->json('Welcome', 200);
});

$router->get('/gtest', 'APIController@gtest');
$router->get('/vehicles/{model_year}/{manufacturer}/{model}', 'APIController@gtest');
$router->post('/vehicles', 'APIController@ptest');

$router->group(['prefix' => 'api/v1/'], function () use ($router) {

    $router->group(['prefix' => 'auth', 'namespace' => 'Auth'], function () use ($router) {
        $router->post('/register', 'AuthController@register');
        $router->post('/login', 'AuthController@login');
        $router->post('/refresh/me', 'AuthController@refreshToken');
    });
});
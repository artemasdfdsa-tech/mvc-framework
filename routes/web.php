<?php

$app = $GLOBALS['app'] ?? null;
$router = $app->getRouter();
$router->get('/', function() {
    return 'Welcome to the Laravel-like MVC Framework!';
});

$router->get('/index', function() {
    return 'Welcome to the Laravel-like MVC Framework!';
});

$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users', 'UserController@store');
<?php

// The Application instance is available in $GLOBALS['app'] which was set in Application constructor
$app = $GLOBALS['app'] ?? null;
$router = $app->getRouter();

// Define routes
$router->get('/', function() {
    return 'Welcome to the Laravel-like MVC Framework!';
});

$router->get('/index', function() {
    return 'Welcome to the Laravel-like MVC Framework!';
});

$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users', 'UserController@store');
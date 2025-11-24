<?php

$app = $GLOBALS['app'] ?? null;
$router = $app->getRouter();

$router->get('/index', 'AuthController@dashboard');
$router->get('/register', 'AuthController@showRegistrationForm');
$router->post('/register', 'AuthController@register');
$router->get('/login', 'AuthController@showLoginForm');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->get('/dashboard', 'AuthController@dashboard');
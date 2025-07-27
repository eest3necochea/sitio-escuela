<?php

require 'vendor/autoload.php';
$f3 = \Base::instance();

// Set debug level (0-3)
$f3->set('DEBUG', 3);

// Set the base path for the application


// Set the default timezone
date_default_timezone_set('America/Argentina/Buenos_Aires');

// Set the autoload paths for the application
$f3->set('AUTOLOAD', './controllers/;./views/;./config/');


// ROUTES

$routes = [
    "public" => [
        'home' => 'GET /',
        'school' => 'GET /school',
        'login' => 'GET /login',
        'GET /user/dashboard',
        'GET /logout',
        'GET /socio/@name'
    ],
    "private" => [
        'dashboard' => 'GET /user/dashboard',
        'GET /user/logout'
    ]
];

// PUBLIC ROUTES
$f3->route(
    $routes["public"]['home'],
    'HomeController->homeAction'
);

$f3->route(
    $routes["public"]['school'],
    'HomeController->schoolAction'
);

$f3->route(
    $routes["public"]['login'],
    'AuthController->loginAction'
);




// PRIVATE ROUTES
$f3->route(
    $routes["private"]['dashboard'],
    'UserController->dashboardAction'
);

$f3->route(
    'GET /logout',
    'AuthController->logoutAction'
);

$f3->route(
    'GET /socio/@name',
    'SocioController->mensajeAction'
);




// RUNNING THE APPLICATION

$f3->run();

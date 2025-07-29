<?php

require 'vendor/autoload.php';
$f3 = \Base::instance();

// Set debug level (0-3)
$f3->set('DEBUG', 3);

// Set the default timezone
date_default_timezone_set('America/Argentina/Buenos_Aires');

// Set the autoload paths for the application
$f3->set('AUTOLOAD', './controllers/;./views/;./config/');

// ROUTES
// Define the routing configuration
// This configuration defines public and private routes
$routing = [
    "public" => [
        'GET' => [
            'home' => '/',
            'school' => '/school',
            'login' => '/login'
        ]
    ],
    "private" => [
        'GET' => [
            'dashboard' => '/user/dashboard',
            'logout' => '/logout'
        ]
    ]
];
$f3->set('routing', $routing);


// PUBLIC routing
$f3->route(
    "GET " . $routing["public"]["GET"]['home'],
    'HomeController->homeAction'
);
$f3->route(
    "GET " . $routing["public"]["GET"]['school'],
    'HomeController->schoolAction'
);
$f3->route(
    "GET " . $routing["public"]["GET"]['login'],
    'AuthController->loginAction'
);


// PRIVATE routing
$f3->route(
    "GET " . $routing["private"]["GET"]['dashboard'],
    'UserController->dashboardAction'
);
$f3->route(
    "GET " . $routing["private"]["GET"]['logout'],
    'AuthController->logoutAction'
);


// RUNNING THE APPLICATION
$f3->run();

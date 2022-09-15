<?php


use IdTravel\Challenge\Router;
use IdTravel\Challenge\Controllers\LoginController;
use IdTravel\Challenge\Controllers\SearchController;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function () {
    header("Location: http://localhost:8881/search", TRUE, 301);
    exit();
});

$router->get('/login', LoginController::class . '@loginView');
$router->post('/login', LoginController::class . '@login');
$router->get('/logout', LoginController::class . '@logout');

$router->get('/search', SearchController::class . '@search');

$router->addPageNotFoundHandler(function () {
    require_once __DIR__ . '/../resources/views/errors/404.php';
});

$router->run();

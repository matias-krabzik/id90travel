<?php

use IdTravel\Challenge\Router;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->getView('/', 'index');

$router->addPageNotFoundHandler(function () {
    return __DIR__ . '../resources/views/404.php';
});

$router->run();

<?php

require '../vendor/autoload.php';

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

//Container
$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

$app = AppFactory::createFromContainer($container);

// Parse json, form data and xml
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Routes
$routes = require '../app/routes.php';
$routes($app);

$app->run();

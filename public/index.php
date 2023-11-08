<?php

require '../vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

//Container
$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

$app = AppFactory::createFromContainer($container);

$container->set(ResponseFactoryInterface::class, function () use ($app) {
    return $app->getResponseFactory();
});

// Parse json, form data and xml
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Routes
$routes = require '../app/routes.php';
$routes($app);

$app->run();

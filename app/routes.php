<?php

declare(strict_types=1);

use MoneyTransfer\Application\Controllers\User\UserController;
use MoneyTransfer\Application\Middlewares\User\CreateUserMiddleware;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/v1', function (RouteCollectorProxy $group) {
        $group->get('', function (Request $request, Response $response) {
            $payload = json_encode(['status' => 'OK', 'message' => 'API v1 is running']);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        });

        $group->post('/users/create', [UserController::class, 'create'])
            ->setName('users.create')
            ->add(CreateUserMiddleware::class);
    });
};

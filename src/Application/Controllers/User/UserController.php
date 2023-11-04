<?php

namespace MoneyTransfer\Application\Controllers\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    public function create(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $response->getBody()->write(json_encode($body));
        return $response;
    }
}

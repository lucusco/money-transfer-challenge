<?php

declare(strict_types=1);

namespace MoneyTransfer\Application\Middlewares\User;

use MoneyTransfer\Application\Validators\UserValidator;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;

class CreateUserMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly UserValidator $validator,
        private readonly ResponseFactoryInterface $responseFactory
    ) {
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $ok = $this->validate($request);

        if (!$ok) {
            $response = $this->responseFactory
                ->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
            $response->getBody()->write(json_encode(['message' => 'Invalid data provided']));

            return $response;
        }

        return $handler->handle($request);
    }

    private function validate(Request $request)
    {
        try {
            return $this->validator->validate($request);
        } catch (\Exception $e) {
            return false;
        }
    }
}

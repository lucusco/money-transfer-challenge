<?php

declare(strict_types=1);

namespace MoneyTransfer\Application\Middlewares\User;

use MoneyTransfer\Application\Middlewares\PostValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;
use Illuminate\Support\Facades\Validator;

class CreateUserMiddleware implements MiddlewareInterface
{
    /*public function __construct(private PostValidator $validator)
    {
    }*/

    public function process(Request $request, RequestHandler $handler): Response
    {
        //$ok = $this->validate($request);

        return $handler->handle($request);
    }

    private function validate(Request $request)
    {
        try {
            $this->validator->with($request->getParsedBody())
                ->passesOrFail(ValidatorInterface::RULE_CREATE);

            return true;
        } catch (ValidatorException $e) {
            return false;
        }
    }
}

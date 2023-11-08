<?php

declare(strict_types=1);

namespace MoneyTransfer\Application\Validators;

use Laminas\InputFilter\Factory;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\StringLength;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserValidator
{
    public function validate(Request $request): bool
    {
        $factory = new Factory();
        $inputFilter = $factory->createInputFilter([
            'name' => [
                'name'       => 'name',
                'required'   => true,
                'validators' => [
                    [
                        'name' => NotEmpty::class,
                    ],
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 3
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->setData($request->getParsedBody());

        return $inputFilter->isValid();
    }
}

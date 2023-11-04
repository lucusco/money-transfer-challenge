<?php

declare(strict_types=1);

namespace MoneyTransfer\Application\Middlewares;

//use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PostValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'age'  => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required'
        ]
    ];
}

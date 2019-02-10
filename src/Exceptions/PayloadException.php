<?php

namespace Santosh\Client\Exceptions;


use Mockery\Exception;
use Throwable;

class PayloadException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
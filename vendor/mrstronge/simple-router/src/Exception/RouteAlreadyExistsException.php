<?php

namespace MrStronge\SimpleRouter\Exception;

class RouteAlreadyExistsException extends \BadMethodCallException implements ExceptionInterface
{
    public const MESSAGE = 'Route already exists';

    public function __construct(
        string $message = self::MESSAGE,
        int $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
<?php

namespace kikimarik\lognote\target\file;

use Throwable;

final class InvalidFileException extends \RuntimeException
{
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

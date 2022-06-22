<?php

namespace kikimarik\lognote\target\file;

use RuntimeException;
use Throwable;

final class FileNotAccessibleException extends RuntimeException
{
    public function __construct(string $path, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("$path is not accessible. Please check permissions.", $code, $previous);
    }
}

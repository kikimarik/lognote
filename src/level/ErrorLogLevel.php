<?php

namespace kikimarik\lognote\level;

use kikimarik\lognote\core\LogLevel;

final class ErrorLogLevel implements LogLevel
{
    /**
     * @return string
     */
    public function present(): string
    {
        return "error";
    }
}

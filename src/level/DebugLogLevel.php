<?php

namespace kikimarik\lognote\level;

use kikimarik\lognote\core\LogLevel;

class DebugLogLevel implements LogLevel
{

    public function present(): string
    {
        return "debug";
    }
}
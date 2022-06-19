<?php

namespace kikimarik\lognote\level;

use kikimarik\lognote\core\LogLevel;

final class DebugLogLevel implements LogLevel
{

    public function present(): string
    {
        return "debug";
    }

    public function assertLessThenOrEqual(LogLevel $level): bool
    {
        return $this->weigh() <= $level->weigh();
    }

    public function weigh(): int
    {
        return 1;
    }
}
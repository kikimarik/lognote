<?php

namespace kikimarik\lognote\level;

use kikimarik\lognote\core\LogLevel;

final class FatalLogLevel implements LogLevel
{

    public function present(): string
    {
        return "fatal";
    }

    public function assertLessThenOrEqual(LogLevel $level): bool
    {
        return $this->weigh() <= $level->weigh();
    }

    public function weigh(): int
    {
        return 6;
    }
}

<?php

namespace kikimarik\lognote\level;

use kikimarik\lognote\core\LogLevel;

final class WarningLogLevel implements LogLevel
{
    /**
     * @return string
     */
    public function present(): string
    {
        return "warning";
    }

    public function assertLessThenOrEqual(LogLevel $level): bool
    {
        return $this->weigh() <= $level->weigh();
    }

    public function weigh(): int
    {
        return 4;
    }
}
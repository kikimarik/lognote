<?php

namespace kikimarik\lognote\level;

use kikimarik\lognote\core\LogLevel;

final class InfoLogLevel implements LogLevel
{
    /**
     * @return string
     */
    public function present(): string
    {
        return "info";
    }

    public function assertLessThenOrEqual(LogLevel $level): bool
    {
        return $this->weigh() <= $level->weigh();
    }

    public function weigh(): int
    {
        return 2;
    }
}
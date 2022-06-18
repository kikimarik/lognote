<?php

namespace kikimarik\lognote\level;

use kikimarik\lognote\core\LogLevel;

final class NoticeLogLevel implements LogLevel
{

    public function present(): string
    {
        return "notice";
    }

    public function assertLessThenOrEqual(LogLevel $level): bool
    {
        return $this->weigh() <= $level->weigh();
    }

    public function weigh(): int
    {
        return 3;
    }
}

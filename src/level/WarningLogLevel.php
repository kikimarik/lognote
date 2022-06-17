<?php

namespace kikimarik\lognote\level;

final class WarningLogLevel implements \kikimarik\lognote\core\LogLevel
{
    /**
     * @return string
     */
    public function present(): string
    {
        return "warning";
    }
}
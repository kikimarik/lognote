<?php

namespace kikimarik\lognote\level;

final class InfoLogLevel implements \kikimarik\lognote\core\LogLevel
{
    /**
     * @return string
     */
    public function present(): string
    {
        return "info";
    }
}
<?php

namespace kikimarik\lognote\core;

interface LogLine
{
    /**
     * Accept the log line level.
     *
     * @param LogLevel $level
     */
    public function acceptLevel(LogLevel $level): void;

    /**
     * Present line fields.
     *
     * @return array
     */
    public function presentBody(): array;
}

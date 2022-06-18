<?php

namespace kikimarik\lognote\core;

interface LogLevel
{
    public function present(): string;

    public function assertLessThenOrEqual(LogLevel $level): bool;

    public function weigh(): int;
}

<?php

namespace kikimarik\lognote\tests\unit\level;

use kikimarik\lognote\core\LogLevel;

final class FakeLogLevel implements LogLevel
{
    private string $name;
    private int $weight;

    public function __construct(string $name, int $weight)
    {
        $this->name = $name;
        $this->weight = $weight;
    }

    public function present(): string
    {
        return $this->name;
    }

    public function assertLessThenOrEqual(LogLevel $level): bool
    {
        return $this->weigh() <= $level->weigh();
    }

    public function weigh(): int
    {
        return $this->weight;
    }
}

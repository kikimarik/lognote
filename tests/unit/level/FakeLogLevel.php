<?php

namespace kikimarik\lognote\tests\unit\level;

use kikimarik\lognote\core\LogLevel;

final class FakeLogLevel implements LogLevel
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function present(): string
    {
        return $this->name;
    }
}

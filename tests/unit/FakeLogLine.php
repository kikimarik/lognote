<?php

namespace kikimarik\lognote\tests\unit;

use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;

final class FakeLogLine implements LogLine
{
    private LogLevel $level;
    private string $foo;
    private string $bar;

    public function __construct(string $foo, string $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
        $this->level = new FakeLogLevel("fakeDefault", 1);
    }

    /**
     * @inheritDoc
     */
    public function acceptLevel(LogLevel $level): void
    {
        $this->level = $level;
    }

    /**
     * @inheritDoc
     */
    public function presentBody(): array
    {
        return [
            "level" => $this->level->present(),
            "foo" => $this->foo,
            "bar" => $this->bar,
        ];
    }
}

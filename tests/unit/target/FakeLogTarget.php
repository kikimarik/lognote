<?php

namespace kikimarik\lognote\tests\unit\target;

use kikimarik\lognote\core\LogTarget;

final class FakeLogTarget implements LogTarget
{
    private array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function write(string $lineBody): void
    {
        $this->data[] = $lineBody;
    }

    public function pullData(): array
    {
        $data = $this->data;
        $this->data = [];
        return $data;
    }
}

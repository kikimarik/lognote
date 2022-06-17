<?php

namespace kikimarik\lognote\tests\unit\format;

use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\core\LogLineFormat;

final class FakeLogLineFormat implements LogLineFormat
{
    private string $separator;

    public function __construct(string $separator)
    {
        $this->separator = $separator;
    }

    /**
     * @inheritDoc
     */
    public function handle(LogLine $line): string
    {
        return implode($this->separator, $line->presentBody());
    }
}

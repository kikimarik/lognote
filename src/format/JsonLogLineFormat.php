<?php

namespace kikimarik\lognote\format;

use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\core\LogLineFormat;

final class JsonLogLineFormat implements LogLineFormat
{
    public function handle(LogLine $line): string
    {
        return json_encode($line->presentBody());
    }
}

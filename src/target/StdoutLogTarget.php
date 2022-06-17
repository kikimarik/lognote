<?php

namespace kikimarik\lognote\target;

use kikimarik\lognote\core\LogTarget;

final class StdoutLogTarget implements LogTarget
{

    public function write(string $lineBody): void
    {
        fwrite(\STDOUT, $lineBody . PHP_EOL);
    }
}
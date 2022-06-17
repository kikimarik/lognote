<?php

namespace kikimarik\lognote\core;

interface LogTarget
{
    public function write(string $lineBody): void;
}

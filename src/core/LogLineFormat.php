<?php

namespace kikimarik\lognote\core;

interface LogLineFormat
{
    /**
     * Handle by the format.
     *
     * @param LogLine $line
     * @return string
     */
    public function handle(LogLine $line): string;
}

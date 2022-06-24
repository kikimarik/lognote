<?php

namespace kikimarik\lognote\format;

use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\core\LogLineFormat;

final class SquareBracketFormatLogLineFormat implements LogLineFormat
{
    private string $separator;

    public function __construct(string $separator = ": ")
    {
        $this->separator = $separator;
    }

    /**
     * @inheritDoc
     */
    public function handle(LogLine $line): string
    {
        $body = "";
        foreach ($line->presentBody() as $field => $value) {
            $body .= "[";
            $body .= "$field{$this->separator}$value";
            $body .= "] ";
        }
        return rtrim($body);
    }
}

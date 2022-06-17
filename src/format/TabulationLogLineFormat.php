<?php

namespace kikimarik\lognote\format;

use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\core\LogLineFormat;

final class TabulationLogLineFormat implements LogLineFormat
{
    private int $spaceSize;

    public function __construct(int $spaceSize)
    {
        $this->spaceSize = $spaceSize;
    }

    /**
     * @inheritDoc
     */
    public function handle(LogLine $line): string
    {
        $body = "";
        $data = $line->presentBody();
        foreach ($data as $field => $value) {
            $separator = array_key_last($data) === $field ? "" : str_repeat(" ", $this->spaceSize);
            $body .= "$value$separator";
        }
        return $body;
    }
}

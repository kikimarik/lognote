<?php

namespace kikimarik\lognote;

use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\level\ErrorLogLevel;

final class MessageLogLine implements LogLine
{
    private string $date;
    private string $message;
    private LogLevel $level;

    public function __construct(string $message)
    {
        $this->date = date("Y-m-d H:i:s");
        $this->acceptLevel(new ErrorLogLevel());
        $this->message = $message;
    }

    public function presentBody(): array
    {
        return [
            "date" => $this->date,
            "level" => $this->level->present(),
            "message" => $this->message
        ];
    }

    public function acceptLevel(LogLevel $level): void
    {
        $this->level = $level;
    }
}

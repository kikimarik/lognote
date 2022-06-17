<?php

namespace kikimarik\lognote;

use Exception;
use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\level\DebugLogLevel;
use kikimarik\lognote\level\ErrorLogLevel;

final class ExceptionLogLine implements core\LogLine
{
    private Exception $exception;
    private string $date;
    private LogLevel $level;

    public function __construct(\Exception $exception)
    {
        $this->date = date("Y-m-d H:i:s");
        $this->acceptLevel(new ErrorLogLevel());
        $this->exception = $exception;
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
        $body = [
            "date" => $this->date,
            "level" => $this->level->present(),
            "code" => $this->exception->getCode(),
            "error" => $this->exception->getMessage(),
        ];
        if ($this->level instanceof DebugLogLevel) {
            $body["trace"] = $this->exception->getTraceAsString();
        }
        return $body;
    }
}
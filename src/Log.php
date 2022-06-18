<?php

namespace kikimarik\lognote;

use kikimarik\lognote\core\LogComponent;
use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\core\LogLineFormat;
use kikimarik\lognote\core\LogTarget;
use kikimarik\lognote\level\DebugLogLevel;
use kikimarik\lognote\level\ErrorLogLevel;
use kikimarik\lognote\level\InfoLogLevel;
use kikimarik\lognote\level\WarningLogLevel;

final class Log implements LogComponent
{
    private LogTarget $target;
    private LogLineFormat $format;

    public function __construct(LogTarget $target, LogLineFormat $format)
    {
        $this->target = $target;
        $this->format = $format;
    }

    public function send(LogLine $line, LogLevel $level): void
    {
        $line->acceptLevel($level);
        $this->target->write($this->format->handle($line));
    }

    public function sendError(LogLine $line): void
    {
        $this->send($line, new ErrorLogLevel());
    }

    public function sendWarning(LogLine $line): void
    {
        $this->send($line, new WarningLogLevel());
    }

    public function sendInfo(LogLine $line): void
    {
        $this->send($line, new InfoLogLevel());
    }

    public function sendDebug(LogLine $line): void
    {
        $this->send($line, new DebugLogLevel());
    }
}
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

    public function receive(LogLine $line, LogLevel $level): void
    {
        $line->acceptLevel($level);
        $this->target->write($this->format->handle($line));
    }

    public function receiveError(LogLine $line): void
    {
        $this->receive($line, new ErrorLogLevel());
    }

    public function receiveWarning(LogLine $line): void
    {
        $this->receive($line, new WarningLogLevel());
    }

    public function receiveInfo(LogLine $line): void
    {
        $this->receive($line, new InfoLogLevel());
    }

    public function receiveDebug(LogLine $line): void
    {
        $this->receive($line, new DebugLogLevel());
    }
}

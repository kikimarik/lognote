<?php

namespace kikimarik\lognote;

use kikimarik\lognote\core\LogComponent;
use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\core\LogLineFormat;
use kikimarik\lognote\core\LogTarget;
use kikimarik\lognote\level\DebugLogLevel;
use kikimarik\lognote\level\ErrorLogLevel;
use kikimarik\lognote\level\FatalLogLevel;
use kikimarik\lognote\level\InfoLogLevel;
use kikimarik\lognote\level\NoticeLogLevel;
use kikimarik\lognote\level\WarningLogLevel;

final class Log implements LogComponent
{
    private LogTarget $target;
    private LogLineFormat $format;
    private LogLevel $allowedLevel;

    public function __construct(LogTarget $target, LogLineFormat $format, LogLevel $allowedLevel)
    {
        $this->target = $target;
        $this->format = $format;
        $this->allowedLevel = $allowedLevel;
    }

    public function receive(LogLine $line, LogLevel $level): void
    {
        if ($this->allowedLevel->assertLessThenOrEqual($level)) {
            $line->acceptLevel($level);
            $this->target->write($this->format->handle($line));
        }
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

    public function receiveFatal(LogLine $line): void
    {
        $this->receive($line, new FatalLogLevel());
    }

    public function receiveNotice(LogLine $line): void
    {
        $this->receive($line, new NoticeLogLevel());
    }
}

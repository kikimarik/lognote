<?php

namespace kikimarik\lognote\core;

interface LogComponent
{
    public function receive(LogLine $line, LogLevel $level): void;

    public function receiveFatal(LogLine $line): void;

    public function receiveError(LogLine $line): void;

    public function receiveWarning(LogLine $line): void;

    public function receiveNotice(LogLine $line): void;

    public function receiveInfo(LogLine $line): void;

    public function receiveDebug(LogLine $line): void;
}

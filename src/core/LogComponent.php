<?php

namespace kikimarik\lognote\core;

interface LogComponent
{
    public function send(LogLine $line, LogLevel $level): void;

    public function sendError(LogLine $line): void;

    public function sendWarning(LogLine $line): void;

    public function sendInfo(LogLine $line): void;

    public function sendDebug(LogLine $line): void;
}

<?php

use kikimarik\lognote\ExceptionLogLine;
use kikimarik\lognote\format\SquareBracketFormatLogLineFormat;
use kikimarik\lognote\level\DebugLogLevel;
use kikimarik\lognote\Log;
use kikimarik\lognote\target\StdoutLogTarget;

require_once __DIR__ . "/../vendor/autoload.php";

$errorLog = new Log(
    new StdoutLogTarget(),
    new SquareBracketFormatLogLineFormat(),
    new DebugLogLevel()
);

function throwSomething(string $message, int $code = 0, $previous = null): void
{
    /**
     * Do something
     */
    throw new RuntimeException($message, $code, $previous);
}

try {
    throwSomething("Invalid route /test.");
} catch (Exception $exception) {
    try {
        throwSomething("Page not found.", 404, $exception);
    } catch (Exception $exception) {
        $errorLog->receiveDebug(new ExceptionLogLine($exception));
    }
}
/**
 * Your console output will be like this:
[date: 2022-06-17 22:23:27] [level: debug] [code: 404] [error: Page not found.] [trace: #0 /home/kikimarik/lognote/example/squareBracketFileTargetDebugLogExample.php(25): throwSomething() #1 {main}] */
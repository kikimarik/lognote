<?php

use kikimarik\lognote\ExceptionLogLine;
use kikimarik\lognote\format\JsonLogLineFormat;
use kikimarik\lognote\Log;
use kikimarik\lognote\target\StdoutLogTarget;

require_once __DIR__ . "/../vendor/autoload.php";

$errorLog = new Log(new StdoutLogTarget(), new JsonLogLineFormat());

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
        $errorLog->sendDebug(new ExceptionLogLine($exception));
    }
}
/**
 * Your console output will be like this:
{"date":"2022-06-17 22:17:34","level":"debug","code":404,"error":"Page not found.","trace":"#0 \/home\/kikimarik\/lognote\/example\/jsonStdoutDebugLogExample.php(24): throwSomething()\n#1 {main}"}
 */
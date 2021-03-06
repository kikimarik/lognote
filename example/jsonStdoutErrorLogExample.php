<?php

use kikimarik\lognote\format\JsonLogLineFormat;
use kikimarik\lognote\level\ErrorLogLevel;
use kikimarik\lognote\Log;
use kikimarik\lognote\MessageLogLine;
use kikimarik\lognote\target\StdoutLogTarget;

require_once __DIR__ . "/../vendor/autoload.php";

$errorLog = new Log(
    new StdoutLogTarget(),
    new JsonLogLineFormat(),
    new ErrorLogLevel()
);

$messages = [
    "example1",
    "example2",
    "example3"
];

foreach ($messages as $message) {
    $errorLog->receiveError(new MessageLogLine($message));
}
$errorLog->receiveInfo(new MessageLogLine("This is a hiding message. Let`s look to the log level."));
/**
 * Your console output will be like this:
{"date":"2022-06-15 17:51:52","level":"error","message":"example1"}
{"date":"2022-06-15 17:51:52","level":"error","message":"example2"}
{"date":"2022-06-15 17:51:52","level":"error","message":"example3"}
 */
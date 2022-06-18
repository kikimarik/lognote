<?php

use kikimarik\lognote\format\SquareBracketFormatLogLineFormat;
use kikimarik\lognote\level\InfoLogLevel;
use kikimarik\lognote\Log;
use kikimarik\lognote\MessageLogLine;
use kikimarik\lognote\target\StdoutLogTarget;

require_once __DIR__ . "/../vendor/autoload.php";

$log = new Log(
    new StdoutLogTarget(),
    new SquareBracketFormatLogLineFormat(" ||| "),
    new InfoLogLevel()
);

$messages = [
    "example1",
    "example2",
    "example3"
];

foreach ($messages as $message) {
    $log->receiveInfo(new MessageLogLine($message));
}
/**
 * Your console output will be like this:
[date: 2022-06-15 18:08:57] [level: info] [message: example1]
[date: 2022-06-15 18:08:57] [level: info] [message: example2]
[date: 2022-06-15 18:08:57] [level: info] [message: example3]
 */
<?php

use kikimarik\lognote\format\TabulationLogLineFormat;
use kikimarik\lognote\Log;
use kikimarik\lognote\MessageLogLine;
use kikimarik\lognote\target\StdoutLogTarget;

require_once __DIR__ . "/../vendor/autoload.php";

$log = new Log(new StdoutLogTarget(), new TabulationLogLineFormat(4));

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
2022-06-15 18:25:48    info    example1
2022-06-15 18:25:48    info    example2
2022-06-15 18:25:48    info    example3
 */
<?php

use kikimarik\lognote\format\JsonLogLineFormat;
use kikimarik\lognote\level\InfoLogLevel;
use kikimarik\lognote\Log;
use kikimarik\lognote\MessageLogLine;
use kikimarik\lognote\target\FileLogTarget;

require_once __DIR__ . "/../vendor/autoload.php";

$log = new Log(
    new FileLogTarget(__DIR__ . "/example.log", true),
    new JsonLogLineFormat(),
    new InfoLogLevel()
);
$log->receiveInfo(new MessageLogLine("Start script info"));
$log->receiveWarning(new MessageLogLine("I`m the warning example"));
$log->receiveInfo(new MessageLogLine("End script info"));
/**
 * It will create file example.log in current dir with content like:
{"date":"2022-06-15 19:25:10","level":"info","message":"Start script info"}
{"date":"2022-06-15 19:25:10","level":"warning","message":"I`m the warning example"}
{"date":"2022-06-15 19:25:10","level":"info","message":"End script info"}
 */
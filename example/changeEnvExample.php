<?php

use kikimarik\lognote\format\TabulationLogLineFormat;
use kikimarik\lognote\level\DebugLogLevel;
use kikimarik\lognote\level\ErrorLogLevel;
use kikimarik\lognote\Log;
use kikimarik\lognote\MessageLogLine;
use kikimarik\lognote\target\StdoutLogTarget;

require_once __DIR__ . "/../vendor/autoload.php";

$env = $argv[1] ?? "prod"; // first param
if ($env === "dev") {
    $level = new DebugLogLevel();
} else {
    $level = new ErrorLogLevel();
}
$log = new Log(
    new StdoutLogTarget(),
    new TabulationLogLineFormat(12),
    $level
);

$log->receiveInfo(new MessageLogLine("Starting the script."));
$log->receiveNotice(new MessageLogLine("You run the script into development environment."));
$log->receiveWarning(new MessageLogLine("The component \"Foo\" is deprecated."));
$log->receiveError(new MessageLogLine("Undefined function \"Foo::bar()\"."));
$log->receiveFatal(new MessageLogLine("Could not continue... Exit."));
$log->receiveDebug(new MessageLogLine("Some debug information..."));
/**
 * When you run this script in the "prod" environment your console output will be like this:
2022-06-18 15:41:49        error        Undefined function "Foo::bar()".
2022-06-18 15:41:49        fatal        Could not continue... Exit.
 * For "dev" environment your console output will be like this:
2022-06-18 15:42:05        info        Starting the script.
2022-06-18 15:42:05        notice        You run the script into development environment.
2022-06-18 15:42:05        warning        The component "Foo" is deprecated.
2022-06-18 15:42:05        error        Undefined function "Foo::bar()".
2022-06-18 15:42:05        fatal        Could not continue... Exit.
2022-06-18 15:42:05        debug        Some debug information...
 */
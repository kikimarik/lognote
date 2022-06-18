# Lognote - standard PHP library for logging
## Features
***
- Object-oriented design (without static methods etc.)
- Compatible with PHP 7.1 and later, including PHP 8.1
- Support for the `json` format
- Ability to write log into the file or print to console output

## Why do you need it
***
The library helps PHP developers to log their application events at different levels. 4 levels have been implemented: errors, warnings, info and debug.

"Lognote" has a nice object-oriented design and it is going to please you with its simplicity. Before testing a class that depends on that library component, it is easy to replace that dependency with a fake class.

## A Simple Example
***

```php
<?php

use kikimarik\lognote\format\JsonLogLineFormat;
use kikimarik\lognote\Log;
use kikimarik\lognote\MessageLogLine;
use kikimarik\lognote\target\FileLogTarget;

//Load Composer's autoloader
require_once __DIR__ . "/../vendor/autoload.php";

$log = new Log(new FileLogTarget(__DIR__ . "/example.log", true), new JsonLogLineFormat());
$log->receiveInfo(new MessageLogLine("Start script info"));
$log->receiveWarning(new MessageLogLine("I`m the warning example"));
$log->receiveInfo(new MessageLogLine("End script info"));
/**
 * It will create file example.log in current dir with content like:
{"date":"2022-06-15 19:25:10","level":"info","message":"Start script info"}
{"date":"2022-06-15 19:25:10","level":"warning","message":"I`m the warning example"}
{"date":"2022-06-15 19:25:10","level":"info","message":"End script info"}
 */
```

## License
***
This software is distributed under the LGPL MIT license.

## Installation
***
Coming soon...

## Tests
***
Coming soon...

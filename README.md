#Lognote - standard PHP library for logging
***
##Features
***
- Object-oriented design (without static methods etc.)
- Compatible with PHP 7.1 and later, including PHP 8.1
- Support for the `json` format
- Ability to write log into the file or print to console output

##Why you might need it
***
The library helps PHP developers log their application events at different levels. At the moment, 3 levels are implemented: errors, warnings and info. In the future, it is planned to add a debug level for comfortable debugging of the application in the dev environment.

"Lognote" has a nice object-oriented design and is sure to please you with its ease of use. When testing a class that has a dependency on a component of this library, it will be very easy to replace it with a fake class.

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
$log->sendInfo(new MessageLogLine("Start script info"));
$log->sendWarning(new MessageLogLine("I`m the warning example"));
$log->sendInfo(new MessageLogLine("End script info"));
/**
 * It will create file example.log in current dir with content like:
{"date":"2022-06-15 19:25:10","level":"info","message":"Start script info"}
{"date":"2022-06-15 19:25:10","level":"warning","message":"I`m the warning example"}
{"date":"2022-06-15 19:25:10","level":"info","message":"End script info"}
 */
```

##License
***
This software is distributed under the LGPL MIT license.

##Installation
***
Coming soon...

##Tests
***
Coming soon...
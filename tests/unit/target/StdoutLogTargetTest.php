<?php

namespace kikimarik\lognote\tests\unit\target;

use Codeception\Test\Unit;
use kikimarik\lognote\target\StdoutLogTarget;

final class StdoutLogTargetTest extends Unit
{
    public function testWrite(): void
    {
        $input = [
            [
                "date" => "2022-06-15 19:25:10",
                "level" => "info",
                "message" => "Start script info"
            ],
            [
                "date" => "2022-06-15 19:25:10",
                "level" => "warning",
                "message" => "I`m the warning example"
            ],
            [
                "date" => "2022-06-15 19:25:10",
                "level" => "info",
                "message" => "End script info"
            ]
        ];
        $target = new StdoutLogTarget();
        foreach ($input as $item) {
            $target->write(json_encode($item));
        }
        $this->expectOutputString(
            "{\"date\":\"2022-06-15 19:25:10\",\"level\":\"info\",\"message\":\"Start script info\"}
{\"date\":\"2022-06-15 19:25:10\",\"level\":\"warning\",\"message\":\"I`m the warning example\"}
{\"date\":\"2022-06-15 19:25:10\",\"level\":\"info\",\"message\":\"End script info\"}
"
        );
    }
}

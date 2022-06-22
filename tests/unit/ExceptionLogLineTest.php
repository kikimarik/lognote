<?php

namespace kikimarik\lognote\tests\unit;

use Codeception\Test\Unit;
use kikimarik\lognote\ExceptionLogLine;
use kikimarik\lognote\MessageLogLine;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;
use RuntimeException;

final class ExceptionLogLineTest extends Unit
{
    public function testAcceptLevel(): void
    {
        $line = new ExceptionLogLine(new RuntimeException("something went wrong..."));
        $level = new FakeLogLevel("fake", 0);
        $line->acceptLevel($level);
        $result = $line->presentBody();
        $this->assertEquals($level->present(), $result["level"]);
    }

    public function testPresentBody(): void
    {
        $line = new ExceptionLogLine(new RuntimeException("something went wrong...", 500));
        $level = new FakeLogLevel("fake", 0);
        $line->acceptLevel($level);
        $result = $line->presentBody();
        $this->assertEqualsWithDelta(time(), strtotime($result["date"]), 1.00);
        $this->assertEquals($level->present(), $result["level"]);
        $this->assertEquals(500, $result["code"]);
        $this->assertEquals("something went wrong...", $result["error"]);
    }
}

<?php

namespace kikimarik\lognote\tests\unit;

use Codeception\Test\Unit;
use kikimarik\lognote\MessageLogLine;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;

final class MessageLogLineTest extends Unit
{
    public function testAcceptLevel(): void
    {
        $line = new MessageLogLine("something...");
        $level = new FakeLogLevel("fake", 0);
        $line->acceptLevel($level);
        $result = $line->presentBody();
        $this->assertEquals($level->present(), $result["level"]);
    }

    public function testPresentBody(): void
    {
        $line = new MessageLogLine("something...");
        $level = new FakeLogLevel("fake", 0);
        $line->acceptLevel($level);
        $result = $line->presentBody();
        $this->assertEqualsWithDelta(time(), strtotime($result["date"]), 1.00);
        $this->assertEquals($level->present(), $result["level"]);
        $this->assertEquals("something...", $result["message"]);
    }
}

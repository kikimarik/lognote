<?php

namespace kikimarik\lognote\tests\unit\level;

use Codeception\Test\Unit;
use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\level\DebugLogLevel;
use kikimarik\lognote\level\ErrorLogLevel;
use kikimarik\lognote\level\FatalLogLevel;
use kikimarik\lognote\level\InfoLogLevel;
use kikimarik\lognote\level\NoticeLogLevel;
use kikimarik\lognote\level\WarningLogLevel;

final class WarningLogLevelTest extends Unit
{
    /**
     * @return void
     */
    public function testWeigh(): void
    {
        $level = new WarningLogLevel();
        $result = $level->weigh();
        $this->assertEquals(4, $result);
    }

    /**
     * @dataProvider testAssertLessThenOrEqualProvider
     * @param LogLevel $inputLevel
     * @param bool $expected
     * @return void
     */
    public function testAssertLessThenOrEqual(LogLevel $inputLevel, bool $expected): void
    {
        $level = new WarningLogLevel();
        $result = $level->assertLessThenOrEqual($inputLevel);
        $this->assertEquals($expected, $result);
    }

    public function testAssertLessThenOrEqualProvider(): array
    {
        return [
            /* Imaginary log level with 0 weight for example */
            [new FakeLogLevel("fake", 0), false],
            /* Debug log level */
            [new DebugLogLevel(), false],
            /* Info log level */
            [new InfoLogLevel(), false],
            /* Notice log level */
            [new NoticeLogLevel(), false],
            /* Warning log level */
            [new WarningLogLevel(), true],
            /* Error log level */
            [new ErrorLogLevel(), true],
            /* Fatal log level */
            [new FatalLogLevel(), true],
        ];
    }
}

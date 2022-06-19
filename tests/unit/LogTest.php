<?php

namespace kikimarik\lognote\tests\unit;

use Codeception\Test\Unit;
use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\Log;
use kikimarik\lognote\tests\unit\format\FakeLogLineFormat;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;
use kikimarik\lognote\tests\unit\target\FakeLogTarget;
use function GuzzleHttp\Promise\all;

final class LogTest extends Unit
{
    private const LEVEL_NAME = "fake";
    private const SEPARATOR = "|";

    /**
     * @dataProvider testReceiveDataProvider
     * @param string $foo
     * @param string $bar
     * @param int $allowedLevel
     * @param int $level
     * @param array $expected
     * @return void
     */
    public function testReceive(string $foo, string $bar, int $allowedLevel, int $level, array $expected): void
    {
        $target = new FakeLogTarget();
        $log = new Log(
            $target,
            new FakeLogLineFormat(self::SEPARATOR),
            new FakeLogLevel(self::LEVEL_NAME, $allowedLevel)
        );
        $log->receive(new FakeLogLine($foo, $bar), new FakeLogLevel(self::LEVEL_NAME, $level));
        $this->assertEquals($expected, $target->pullData());
    }

    public function testReceiveDataProvider(): array
    {
        return [
            /* Level is equal allowed level */
            ["foo", "bar", 1, 1, [self::LEVEL_NAME . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* Level is less than allowed level */
            ["foo", "bar", 2, 1, []],
            /* Level is greater than allowed level */
            ["foo", "bar", 1, 2, [self::LEVEL_NAME . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
        ];
    }
}

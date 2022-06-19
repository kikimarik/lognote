<?php

namespace kikimarik\lognote\tests\unit;

use Codeception\Test\Unit;
use kikimarik\lognote\core\LogLevel;
use kikimarik\lognote\level\DebugLogLevel;
use kikimarik\lognote\level\ErrorLogLevel;
use kikimarik\lognote\level\FatalLogLevel;
use kikimarik\lognote\level\InfoLogLevel;
use kikimarik\lognote\level\NoticeLogLevel;
use kikimarik\lognote\level\WarningLogLevel;
use kikimarik\lognote\Log;
use kikimarik\lognote\tests\unit\format\FakeLogLineFormat;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;
use kikimarik\lognote\tests\unit\target\FakeLogTarget;

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

    /**
     * @dataProvider testReceiveFatalDataProvider
     * @param string $foo
     * @param string $bar
     * @param LogLevel $allowedLevel
     * @param array $expected
     * @return void
     */
    public function testReceiveFatal(string $foo, string $bar, LogLevel $allowedLevel, array $expected): void
    {
        $target = new FakeLogTarget();
        $log = new Log(
            $target,
            new FakeLogLineFormat(self::SEPARATOR),
            $allowedLevel
        );
        $log->receiveFatal(new FakeLogLine($foo, $bar));
        $this->assertEquals($expected, $target->pullData());
    }

    public function testReceiveFatalDataProvider(): array
    {
        return [
            /* When allowed debug */
            ["foo", "bar", new DebugLogLevel(), ["fatal" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed info */
            ["foo", "bar", new InfoLogLevel(), ["fatal" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed notice */
            ["foo", "bar", new NoticeLogLevel(), ["fatal" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed warning */
            ["foo", "bar", new WarningLogLevel(), ["fatal" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed error */
            ["foo", "bar", new ErrorLogLevel(), ["fatal" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed fatal */
            ["foo", "bar", new FatalLogLevel(), ["fatal" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
        ];
    }

    /**
     * @dataProvider testReceiveErrorDataProvider
     * @param string $foo
     * @param string $bar
     * @param LogLevel $allowedLevel
     * @param array $expected
     * @return void
     */
    public function testReceiveError(string $foo, string $bar, LogLevel $allowedLevel, array $expected): void
    {
        $target = new FakeLogTarget();
        $log = new Log(
            $target,
            new FakeLogLineFormat(self::SEPARATOR),
            $allowedLevel
        );
        $log->receiveError(new FakeLogLine($foo, $bar));
        $this->assertEquals($expected, $target->pullData());
    }

    public function testReceiveErrorDataProvider(): array
    {
        return [
            /* When allowed debug */
            ["foo", "bar", new DebugLogLevel(), ["error" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed info */
            ["foo", "bar", new InfoLogLevel(), ["error" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed notice */
            ["foo", "bar", new NoticeLogLevel(), ["error" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed warning */
            ["foo", "bar", new WarningLogLevel(), ["error" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed error */
            ["foo", "bar", new ErrorLogLevel(), ["error" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed fatal */
            ["foo", "bar", new FatalLogLevel(), []],
        ];
    }

    /**
     * @dataProvider testReceiveWarningDataProvider
     * @param string $foo
     * @param string $bar
     * @param LogLevel $allowedLevel
     * @param array $expected
     * @return void
     */
    public function testReceiveWarning(string $foo, string $bar, LogLevel $allowedLevel, array $expected): void
    {
        $target = new FakeLogTarget();
        $log = new Log(
            $target,
            new FakeLogLineFormat(self::SEPARATOR),
            $allowedLevel
        );
        $log->receiveWarning(new FakeLogLine($foo, $bar));
        $this->assertEquals($expected, $target->pullData());
    }

    public function testReceiveWarningDataProvider(): array
    {
        return [
            /* When allowed debug */
            ["foo", "bar", new DebugLogLevel(), ["warning" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed info */
            ["foo", "bar", new InfoLogLevel(), ["warning" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed notice */
            ["foo", "bar", new NoticeLogLevel(), ["warning" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed warning */
            ["foo", "bar", new WarningLogLevel(), ["warning" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed error */
            ["foo", "bar", new ErrorLogLevel(), []],
            /* When allowed fatal */
            ["foo", "bar", new FatalLogLevel(), []],
        ];
    }

    /**
     * @dataProvider testReceiveNoticeDataProvider
     * @param string $foo
     * @param string $bar
     * @param LogLevel $allowedLevel
     * @param array $expected
     * @return void
     */
    public function testReceiveNotice(string $foo, string $bar, LogLevel $allowedLevel, array $expected): void
    {
        $target = new FakeLogTarget();
        $log = new Log(
            $target,
            new FakeLogLineFormat(self::SEPARATOR),
            $allowedLevel
        );
        $log->receiveNotice(new FakeLogLine($foo, $bar));
        $this->assertEquals($expected, $target->pullData());
    }

    public function testReceiveNoticeDataProvider(): array
    {
        return [
            /* When allowed debug */
            ["foo", "bar", new DebugLogLevel(), ["notice" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed info */
            ["foo", "bar", new InfoLogLevel(), ["notice" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed notice */
            ["foo", "bar", new NoticeLogLevel(), ["notice" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed warning */
            ["foo", "bar", new WarningLogLevel(), []],
            /* When allowed error */
            ["foo", "bar", new ErrorLogLevel(), []],
            /* When allowed fatal */
            ["foo", "bar", new FatalLogLevel(), []],
        ];
    }

    /**
     * @dataProvider testReceiveInfoDataProvider
     * @param string $foo
     * @param string $bar
     * @param LogLevel $allowedLevel
     * @param array $expected
     * @return void
     */
    public function testReceiveInfo(string $foo, string $bar, LogLevel $allowedLevel, array $expected): void
    {
        $target = new FakeLogTarget();
        $log = new Log(
            $target,
            new FakeLogLineFormat(self::SEPARATOR),
            $allowedLevel
        );
        $log->receiveInfo(new FakeLogLine($foo, $bar));
        $this->assertEquals($expected, $target->pullData());
    }

    public function testReceiveInfoDataProvider(): array
    {
        return [
            /* When allowed debug */
            ["foo", "bar", new DebugLogLevel(), ["info" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed info */
            ["foo", "bar", new InfoLogLevel(), ["info" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed notice */
            ["foo", "bar", new NoticeLogLevel(), []],
            /* When allowed warning */
            ["foo", "bar", new WarningLogLevel(), []],
            /* When allowed error */
            ["foo", "bar", new ErrorLogLevel(), []],
            /* When allowed fatal */
            ["foo", "bar", new FatalLogLevel(), []],
        ];
    }

    /**
     * @dataProvider testReceiveDebugDataProvider
     * @param string $foo
     * @param string $bar
     * @param LogLevel $allowedLevel
     * @param array $expected
     * @return void
     */
    public function testReceiveDebug(string $foo, string $bar, LogLevel $allowedLevel, array $expected): void
    {
        $target = new FakeLogTarget();
        $log = new Log(
            $target,
            new FakeLogLineFormat(self::SEPARATOR),
            $allowedLevel
        );
        $log->receiveDebug(new FakeLogLine($foo, $bar));
        $this->assertEquals($expected, $target->pullData());
    }

    public function testReceiveDebugDataProvider(): array
    {
        return [
            /* When allowed debug */
            ["foo", "bar", new DebugLogLevel(), ["debug" . self::SEPARATOR . "foo" . self::SEPARATOR . "bar"]],
            /* When allowed info */
            ["foo", "bar", new InfoLogLevel(), []],
            /* When allowed notice */
            ["foo", "bar", new NoticeLogLevel(), []],
            /* When allowed warning */
            ["foo", "bar", new WarningLogLevel(), []],
            /* When allowed error */
            ["foo", "bar", new ErrorLogLevel(), []],
            /* When allowed fatal */
            ["foo", "bar", new FatalLogLevel(), []],
        ];
    }
}

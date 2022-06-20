<?php

namespace kikimarik\lognote\tests\unit\format;

use Codeception\Test\Unit;
use kikimarik\lognote\format\JsonLogLineFormat;
use kikimarik\lognote\tests\unit\FakeLogLine;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;

final class JsonLogLineFormatTest extends Unit
{
    /**
     * @dataProvider testHandleDataProvider
     * @param string $foo
     * @param string $bar
     * @param array $expected
     */
    public function testHandle(string $foo, string $bar, array $expected): void
    {
        $format = new JsonLogLineFormat();
        $line = new FakeLogLine($foo, $bar);
        $line->acceptLevel(new FakeLogLevel("fake", 1));
        $result = $format->handle($line);
        $this->assertEquals($expected, json_decode($result, true));
    }

    public function testHandleDataProvider(): array
    {
        return [
            ["foo", "bar", ["level" => "fake", "foo" => "foo", "bar" => "bar"]],
            ["bar", "bar", ["level" => "fake", "foo" => "bar", "bar" => "bar"]],
            ["bar", "foo", ["level" => "fake", "foo" => "bar", "bar" => "foo"]]
        ];
    }
}

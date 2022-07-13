<?php

namespace kikimarik\lognote\tests\unit\format;

use Codeception\Test\Unit;
use kikimarik\lognote\format\TabulationLogLineFormat;
use kikimarik\lognote\tests\unit\FakeLogLine;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;

final class TabulationLogLineFormatTest extends Unit
{
    /**
     * @dataProvider handleDataProvider
     * @param string $foo
     * @param string $bar
     * @param int $spaceSize
     * @param string $expected
     */
    public function testHandle(string $foo, string $bar, int $spaceSize, string $expected): void
    {
        $format = new TabulationLogLineFormat($spaceSize);
        $line = new FakeLogLine($foo, $bar);
        $line->acceptLevel(new FakeLogLevel("fake", 1));
        $result = $format->handle($line);
        $this->assertEquals($expected, $result);
    }

    public function handleDataProvider(): array
    {
        return [
            ["foo", "bar", 1, "fake foo bar"],
            ["bar", "bar", 1, "fake bar bar"],
            ["bar", "foo", 1, "fake bar foo"],

            ["foo", "bar", 4, "fake    foo    bar"],
        ];
    }
}

<?php

namespace kikimarik\lognote\tests\unit\format;

use Codeception\Test\Unit;
use kikimarik\lognote\format\SquareBracketFormatLogLineFormat;
use kikimarik\lognote\tests\unit\FakeLogLine;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;

final class SquareBracketFormatLogLineFormatTest extends Unit
{
    /**
     * @dataProvider handleDataProvider
     * @param string $foo
     * @param string $bar
     * @param string $separator
     * @param string $expected
     */
    public function testHandle(string $foo, string $bar, string $separator, string $expected): void
    {
        $format = new SquareBracketFormatLogLineFormat($separator);
        $line = new FakeLogLine($foo, $bar);
        $line->acceptLevel(new FakeLogLevel("fake", 1));
        $result = $format->handle($line);
        $this->assertEquals($expected, $result);
    }

    public function handleDataProvider(): array
    {
        return [
            ["foo", "bar", ":", "[level:fake] [foo:foo] [bar:bar]"],
            ["bar", "bar", ":", "[level:fake] [foo:bar] [bar:bar]"],
            ["bar", "foo", ":", "[level:fake] [foo:bar] [bar:foo]"],

            ["foo", "bar", "  ", "[level  fake] [foo  foo] [bar  bar]"],
        ];
    }
}

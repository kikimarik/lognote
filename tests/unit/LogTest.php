<?php

namespace kikimarik\lognote\tests\unit;

use Codeception\Test\Unit;
use kikimarik\lognote\core\LogComponent;
use kikimarik\lognote\core\LogLine;
use kikimarik\lognote\core\LogTarget;
use kikimarik\lognote\Log;
use kikimarik\lognote\tests\unit\format\FakeLogLineFormat;
use kikimarik\lognote\tests\unit\level\FakeLogLevel;
use kikimarik\lognote\tests\unit\target\FakeLogTarget;

final class LogTest extends Unit
{
    private LogComponent $log;
    /* @var LogTarget|FakeLogTarget */
    private LogTarget $target;

    public function __construct()
    {
        $this->target = new FakeLogTarget();
        $this->log = new Log($this->target, new FakeLogLineFormat("|"));
        parent::__construct();
    }

    /**
     * @dataProvider testSendDataProvider
     * @param LogLine[] $lines
     * @param array $expected
     * @return void
     */
    public function testSend(array $lines, array $expected): void
    {
        foreach ($lines as $line) {
            $this->log->send($line, new FakeLogLevel("fake"));
        }
        $this->assertEquals($expected, $this->target->pullData());
    }

    public function testSendDataProvider(): array
    {
        return [
            [
                [
                    new FakeLogLine("foo", "bar")
                ],
                [
                    "foo|bar"
                ]
            ],
            [
                [
                    new FakeLogLine("bar", "bar")
                ],
                [
                    "foo|bar"
                ]
            ]
        ];
    }
}

<?php

namespace kikimarik\lognote\tests\unit\target;

use Codeception\Test\Unit;
use kikimarik\lognote\target\file\FileNotAccessibleException;
use kikimarik\lognote\target\file\FileNotFoundException;
use kikimarik\lognote\target\file\InvalidFileException;
use kikimarik\lognote\target\FileLogTarget;

final class FileLogTargetTest extends Unit
{
    private const FIRST_LINE = "{\"date\":\"2022-06-15 19:25:10\",\"level\":\"info\",\"message\":\"Start script\"}";
    private const SECOND_LINE = "{\"date\":\"2022-06-15 19:25:10\",\"level\":\"error\",\"message\":\"Error example\"}";

    private const LOG_FILE = __DIR__ . "/../../resources/target/file/775/test.log";
    private const NOT_ACCESSIBLE_LOG_FILE = __DIR__ . "/../../resources/target/file/555/test.log";
    private const INVALID_LOG_FILE = __DIR__ . "/../../resources/target/file/invalid/test.log";

    public static function setUpBeforeClass(): void
    {
        mkdir(__DIR__ . "/../../resources/target/file/775", 0775);
        mkdir(__DIR__ . "/../../resources/target/file/555", 0555);
    }

    public static function tearDownAfterClass(): void
    {
        if (file_exists(self::LOG_FILE)) {
            unlink(self::LOG_FILE);
        }
        rmdir(__DIR__ . "/../../resources/target/file/775");
        chmod(__DIR__ . "/../../resources/target/file/555", 0755);
        rmdir(__DIR__ . "/../../resources/target/file/555");
    }

    /**
     * @dataProvider writeDataProvider
     * @param string $input
     * @param string $path
     * @param bool $rewriteMode
     * @param string $expected
     * @return void
     */
    public function testWrite(string $input, string $path, bool $rewriteMode, string $expected): void
    {
        $target = new FileLogTarget($path, $rewriteMode);
        $target->write($input);
        $this->assertEquals($expected, file_get_contents($path));
    }

    public function writeDataProvider(): array
    {
        return [
            [
                self::FIRST_LINE,
                self::LOG_FILE,
                true,
                self::FIRST_LINE . PHP_EOL
            ],
            [
                self::SECOND_LINE,
                self::LOG_FILE,
                true,
                self::FIRST_LINE . PHP_EOL . self::SECOND_LINE . PHP_EOL
            ],
            [
                self::SECOND_LINE,
                self::LOG_FILE,
                false,
                self::SECOND_LINE . PHP_EOL
            ],
        ];
    }

    /**
     * @dataProvider writeNegativeDataProvider
     * @param string $path
     * @param string $exception
     * @param string $message
     * @return void
     */
    public function testWriteNegative(string $path, string $exception, string $message): void
    {
        $this->expectException($exception);
        $this->expectExceptionMessage($message);
        (new FileLogTarget($path, true))
            ->write("something...");
    }

    public function writeNegativeDataProvider(): array
    {
        return [
            [
                self::INVALID_LOG_FILE,
                FileNotFoundException::class,
                self::INVALID_LOG_FILE . " not found."
            ],
            [
                self::NOT_ACCESSIBLE_LOG_FILE,
                FileNotAccessibleException::class,
                self::NOT_ACCESSIBLE_LOG_FILE . " is not accessible. Please check permissions."
            ],
            [
                __DIR__ . "/../../resources/target/file/775",
                InvalidFileException::class,
                __DIR__ . "/../../resources/target/file/775 is a directory."
            ],
        ];
    }
}

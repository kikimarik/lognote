<?php

namespace kikimarik\lognote\target;

use FilesystemIterator;
use kikimarik\lognote\core\LogTarget;
use kikimarik\lognote\target\file\FileNotAccessibleException;
use kikimarik\lognote\target\file\FileNotFoundException;
use kikimarik\lognote\target\file\InvalidFileException;
use UnexpectedValueException;

final class FileLogTarget implements LogTarget
{
    private const CHECKED_PERMISSIONS = 0755;

    private string $path;
    private bool $rewriteMode;

    public function __construct(string $path, bool $rewriteMode)
    {
        $this->path = $path;
        $this->rewriteMode = $rewriteMode;
    }

    public function write(string $lineBody): void
    {
        $dir = explode("/", trim($this->path));
        $file = array_pop($dir);
        try {
            $fsIt = new FilesystemIterator(implode("/", $dir));
        } catch (UnexpectedValueException $e) {
            throw new FileNotFoundException($this->path, $e->getCode(), $e);
        }
        if (!$fsIt->isWritable()) {
            throw new FileNotAccessibleException($this->path);
        }
        foreach ($fsIt as $fsItNode) {
            /* @var \SplFileInfo $fsItNode */
            if ($fsItNode->getFilename() === $file) {
                if ($fsItNode->isDir()) {
                    throw new InvalidFileException("{$this->path} is a directory.");
                }
                if (!$fsItNode->isWritable()) {
                    throw new FileNotAccessibleException($this->path);
                }
                break;
            }
        }
        (new \SplFileObject($this->path, $this->rewriteMode ? "a" : "w"))->fwrite($lineBody . PHP_EOL);
    }
}

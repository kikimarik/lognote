<?php

namespace kikimarik\lognote\target;

use FilesystemIterator;
use kikimarik\lognote\core\LogTarget;

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
        $fsIt = new FilesystemIterator(implode("/", $dir));
        if ($fsIt->getPerms() < self::CHECKED_PERMISSIONS) {
            throw new \RuntimeException("Could not log to the {$this->path} file. Please, check permissions");
        }
        foreach ($fsIt as $fsItNode) {
            if (!$fsItNode->isFile()) {
                continue;
            }
            if ($fsItNode->getFilename() === $file) {
                if (!$fsItNode->isWritable()) {
                    throw new \RuntimeException("Could not take writing access to the {$this->path} file.");
                }
                break;
            }
        }
        (new \SplFileObject($this->path, $this->rewriteMode ? "a" : "w"))->fwrite($lineBody . PHP_EOL);
    }
}

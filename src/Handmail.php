<?php

namespace Cirtool\Handmail;

use Illuminate\Support\Collection;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Handmail
{
    /**
     * Handmail version.
     *
     * @var string
     */
    const VERSION = '0.1.0';

    /**
     * Registered mail building blocks.
     */
    protected Collection $blocks;

    /**
     * Get current Handmail version.
     */
    public function getVersion(): string
    {
        return self::VERSION;
    }

    /**
     * Recursive discover building blocks in a folder 
     * path, reading every TOML file.
     */
    public function discoverBlocks(string $folderPath): void
    {
        $dir = new RecursiveDirectoryIterator($folderPath);
        $files = new RecursiveIteratorIterator($dir);

        
    }
}

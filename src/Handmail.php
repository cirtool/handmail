<?php

namespace Cirtool\Handmail;

use Yosymfony\Toml\Toml;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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

    function __construct() {
        $this->blocks = collect();
    }

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
        $dir = new RecursiveDirectoryIterator($folderPath, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($dir);

        foreach ($files as $file) {
            $pathname = $file->getPathname();

            if (! Str::of($pathname)->endsWith('.toml')) {
                continue;
            }

            $config = Toml::parseFile($pathname);
            $config['name'] = $config['name'] ?? $config['view'];

            /** @var \Cirtool\Handmail\Form\Field */
            $className = config('handmail.blocks.field', \Cirtool\Handmail\Form\BlockField::class);
            $this->blocks->push(new $className($config));
        }
    }
}

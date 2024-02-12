<?php

namespace Cirtool\Handmail;

use Cirtool\Handmail\Form\BlockField;
use Yosymfony\Toml\Toml;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
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

    /**
     * Twig instance.
     */
    protected Environment $twig;

    function __construct() {
        $this->blocks = collect();

        $loader = new FilesystemLoader(config('handmail.blocks.path'));
        $loader->addPath(__DIR__.'/../resources/twig', 'handmail');

        $this->twig = new Environment($loader);
    }

    /**
     * Get current Handmail version.
     */
    public function getVersion(): string
    {
        return self::VERSION;
    }

    public function getTwig(): Environment
    {
        return $this->twig;
    }

    public function getBlocks(): Collection
    {
        return $this->blocks->filter(
            fn (BlockField $block) => $block->isLayout === false);
    }

    public function findBlock(string $name)
    {
        return $this->getBlocks()->first(fn ($block) => $block->name == $name);
    }

    public function getLayouts(): Collection
    {
        return $this->blocks->filter(
            fn (BlockField $block) => $block->isLayout === true);
    }

    public function findLayout(string $name)
    {
        return $this->getLayouts()->first(fn ($block) => $block->name == $name);
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

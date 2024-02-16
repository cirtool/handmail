<?php

namespace Cirtool\Handmail;

use Cirtool\Handmail\Form\BlockField;
use Exception;
use Yosymfony\Toml\Toml;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Yaml\Yaml;

class BlockFactory
{
    /**
     * Registered mail building blocks.
     */
    protected Collection $blocks;

    /**
     * Blocks filesystem path.
     */
    protected string $path;

    /**
     * Construct.
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->blocks = collect();
    }

    /**
     * Get all blocks (filtering blocks or layouts).
     */
    public function all(BlockType $type = BlockType::Block): Collection
    {
        return $this->blocks->filter(fn ($block) => $block->type == $type);
    }

    /**
     * Find a block using their name.
     */
    public function find(string $name, BlockType $type = BlockType::Block): ?BlockField
    {
        return $this->all($type)->first(fn ($block) => $block->name == $name);
    }

    /**
     * Recursive discover building blocks in a folder 
     * path, reading every TOML file.
     */
    public function discover(): void
    {
        $dir = new RecursiveDirectoryIterator($this->path, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($dir);

        foreach ($files as $file) {
            $pathname = $file->getPathname();
            $relativePath = Str::replaceFirst($this->path, '', $pathname);
            $root = Str::replaceMatches('/[\\/\\\\]/', '', dirname($relativePath));

            if (! $this->isConfigFile($pathname)) {
                continue;
            }

            $config = $this->parseConfigFile($pathname);
            $config['name'] = $config['name'] ?? $config['view'];

            $className = config(
                'handmail.blocks.field', \Cirtool\Handmail\Form\BlockField::class);

            /** @var \Cirtool\Handmail\Form\BlockField */
            $block = new $className($config);
            $block->type = $root == 'layouts' ? BlockType::Layout : BlockType::Block;

            $this->blocks->push($block);
        }
    }

    /**
     * Make config from a file path.
     */
    public function parseConfigFile(string $pathname): array
    {
        switch (pathinfo($pathname, PATHINFO_EXTENSION)) {
            case 'toml':
                return Toml::parseFile($pathname);

            case 'yaml':
                return Yaml::parseFile($pathname);
        }

        throw new Exception('Cannot create a config array from: ' . $pathname);
    }

    /**
     * Check if file is a config file.
     */
    public function isConfigFile(string $pathname)
    {
        $extension = pathinfo($pathname, PATHINFO_EXTENSION);
        return in_array($extension, ['toml', 'yaml']);
    }

}

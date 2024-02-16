<?php

namespace Cirtool\Handmail;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Handmail
{
    /**
     * Handmail version.
     *
     * @var string
     */
    const VERSION = '0.1.0';

    /**
     * Twig instance.
     */
    protected Environment $twig;

    /**
     * Block Factory instance.
     */
    protected BlockFactory $blockFactory;

    function __construct() 
    {
        $path = config('handmail.blocks.path');
        $loader = new FilesystemLoader($path);

        $this->twig = new Environment($loader);
        $this->blockFactory = new BlockFactory($path);
    }

    /**
     * Get current Handmail version.
     */
    public function getVersion(): string
    {
        return self::VERSION;
    }

    /** 
     * Get Twig instante.
     */
    public function getTwig(): Environment
    {
        return $this->twig;
    }

    /**
     * Get Block Factory instance.
     */
    public function getBlockFactory()
    {
        return $this->blockFactory;
    }
}

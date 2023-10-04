<?php

namespace Cirtool\Handmail;

class Handmail
{
    /**
     * Handmail version.
     *
     * @var string
     */
    const VERSION = '0.1.0';

    public function getVersion(): string
    {
        return self::VERSION;
    }
}

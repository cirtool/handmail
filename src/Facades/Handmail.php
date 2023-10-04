<?php

namespace Cirtool\Handmail\Facades;

use Illuminate\Support\Facades\Facade;

class Handmail extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'cirtool.handmail';
    }
}

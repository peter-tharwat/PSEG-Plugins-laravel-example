<?php

namespace Moamalat\Payment\Facades;

use Illuminate\Support\Facades\Facade;

class Moamalat extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'moamalat';
    }
}
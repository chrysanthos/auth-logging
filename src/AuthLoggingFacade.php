<?php

namespace Chrysanthos\AuthLogging;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chrysanthos\AuthLogging\AuthLogging
 */
class AuthLoggingFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        // "aliases": {
        //                "AuthLogging": "Chrysanthos\\AuthLogging\\AuthLoggingFacade"
        //            }
        return 'auth-logging';
    }
}

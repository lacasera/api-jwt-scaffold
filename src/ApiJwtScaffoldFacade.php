<?php

namespace Lacasera\ApiJwtScaffold;

use Illuminate\Support\Facades\Facade;

class ApiJwtScaffoldFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'api-jwt-scaffold';
    }
}

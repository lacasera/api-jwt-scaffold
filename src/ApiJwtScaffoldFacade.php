<?php

namespace Lacasera\ApiJwtScaffold;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lacasera\ApiJwtScaffold\Skeleton\SkeletonClass
 */
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

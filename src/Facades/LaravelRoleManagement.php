<?php

namespace Pooyadch\LaravelRoleManagement\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelRoleManagement extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelrolemanagement';
    }
}

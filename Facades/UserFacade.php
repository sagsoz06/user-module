<?php namespace Modules\User\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\User\Contracts\Authentication;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Authentication::class;
    }
}
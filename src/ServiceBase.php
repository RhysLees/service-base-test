<?php

namespace RhysLees\ServiceBase;

use RhysLees\ServiceBase\Nova\Resources\User;
use RhysLees\ServiceBase\Nova\Resources\UserCopy;

class ServiceBase
{
    public static function event(string $name)
    {
        # code...
        return $name;
    }

    public static function NovaResources()
    {
        return [
            User::class,
            UserCopy::class
        ];
    }
}

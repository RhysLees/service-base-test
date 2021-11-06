<?php

namespace RhysLees\ServiceBase\Traits;

use Spark\Billable;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ServiceBase
{

    public function getConnectionName()
    {
        return 'servicebase';
    }

}

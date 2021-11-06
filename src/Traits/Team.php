<?php

namespace RhysLees\ServiceBase\Traits;

use Spark\Billable;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Team
{
    use Billable;

    public function stripeEmail()
    {
        return $this->owner->email;
    }

    protected $connection = 'servicebase';

    /**
     * Get all of the forms for the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }

    /**
     * Get all of the clients for the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}

<?php

namespace App\Models;

use RhysLees\ServiceBase\Traits\ServiceBase;
use Laravel\Jetstream\Membership as JetstreamMembership;

class Membership extends JetstreamMembership
{
    use ServiceBase;

    protected $connection = 'servicebase';
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}

<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use \Illuminate\Auth\Authenticatable as Authable;

abstract class Authenticatable extends ModelUuid implements AuthenticatableContract
{
    use Authable;
}

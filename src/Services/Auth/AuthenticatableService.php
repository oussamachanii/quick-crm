<?php

namespace Crm\Services\Auth;

use App\Entities\Authenticatable;
use Crm\Services\BaseService;

abstract class AuthenticatableService extends BaseService
{
    abstract function findById(string $id): ?Authenticatable;
}

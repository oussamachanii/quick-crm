<?php

namespace Crm\Managers\Auth\Employee;

use Crm\Managers\Auth\BaseAuthManager;
use Crm\Services\Employee\EmployeeService;

class EmployeeAuthManager extends BaseAuthManager
{
    protected const GUARD_NAME = 'employee-web';

    public function __construct(private readonly EmployeeService $employeeService)
    {
        parent::__construct($this->employeeService);
    }
}

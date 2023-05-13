<?php

namespace Crm\Managers\Auth\Employee;

use Crm\Managers\Auth\BaseAuthManager;
use Crm\Services\Employee\EmployeeService;

class EmployeeAuthManager extends BaseAuthManager
{
    public const GUARD_NAME = 'employee-web';
    public const HOME_PAGE = 'employee.dashboard';

    public function __construct(private readonly EmployeeService $employeeService)
    {
        parent::__construct($this->employeeService);
    }

    protected function guard()
    {
        return $this->authManager->guard(self::GUARD_NAME);
    }
}

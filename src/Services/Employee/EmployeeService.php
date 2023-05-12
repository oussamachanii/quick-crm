<?php

namespace Crm\Services\Employee;

use App\Entities\Employee\Employee;
use Crm\Repositories\Employee\EmployeeRepository;
use Crm\Services\Auth\AuthenticatableService;

class EmployeeService extends AuthenticatableService
{
    public function __construct(
        private readonly EmployeeRepository $employeeRepository
    ) {
    }

    public function findById(string $id): ?Employee
    {
        return $this->employeeRepository->findById($id);
    }

    public function findByEmail(string $email): ?Employee
    {
        return $this->employeeRepository->findByEmail($email);
    }
}

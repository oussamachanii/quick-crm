<?php

namespace Crm\Repositories\Employee;

use App\Entities\Employee\Employee;
use Crm\Repositories\BaseRepository;

class EmployeeRepository extends BaseRepository
{
    public function findById(string $employeeId): ?Employee
    {
        return Employee::query()
            ->where(Employee::ID_COLUMN, $employeeId)
            ->first();
    }
}

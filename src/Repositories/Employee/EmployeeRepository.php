<?php

namespace Crm\Repositories\Employee;

use App\Entities\Employee\Employee;
use Crm\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class EmployeeRepository extends BaseRepository
{
    public function findById(string $employeeId): ?Employee
    {
        return Employee::query()
            ->where(Employee::ID_COLUMN, $employeeId)
            ->first();
    }

    public function findByEmail(string $email): ?Employee
    {
        return Employee::query()
            ->where(Employee::EMAIL_COLUMN, $email)
            ->first();
    }

    public function getByCompanyId(string $companyId): Collection
    {
        return Employee::query()
            ->where(Employee::COMPANY_ID_COLUMN, $companyId)
            ->get();
    }
}

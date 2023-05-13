<?php

namespace Crm\Repositories\Employee;

use App\Entities\Employee\Employee;
use App\Entities\Invitation\Invitation;
use Crm\Repositories\BaseRepository;
use Illuminate\Support\Arr;
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

    public function create(array $attributes): Employee
    {
        $attributes = Arr::only(
            $attributes,
            [
                Employee::EMAIL_COLUMN,
                Employee::NAME_COLUMN,
                Employee::COMPANY_ID_COLUMN,
                Employee::ADDRESS_COLUMN,
                Employee::PHONE_COLUMN,
                Employee::BIRTHDATE_COLUMN,
                Employee::STATUS_COLUMN,
                Employee::PASSWORD_COLUMN,
                Employee::BIRTHDATE_COLUMN,
            ]
        );

        return Employee::query()
            ->create($attributes);
    }

    public function update(string $id, array $attributes): bool
    {
        $attributes = Arr::only(
            $attributes,
            [
                Employee::EMAIL_COLUMN,
                Employee::NAME_COLUMN,
                Employee::COMPANY_ID_COLUMN,
                Employee::ADDRESS_COLUMN,
                Employee::PHONE_COLUMN,
                Employee::BIRTHDATE_COLUMN,
                Employee::STATUS_COLUMN,
                Employee::PASSWORD_COLUMN,
                Employee::BIRTHDATE_COLUMN,
            ]
        );

        return Employee::query()
            ->where(Employee::ID_COLUMN, $id)
            ->update($attributes);
    }
}

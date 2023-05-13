<?php

namespace Crm\Services\Employee;

use App\Entities\Employee\Employee;
use App\Entities\Invitation\Invitation;
use App\Enums\EmployeeStatus;
use Crm\Repositories\Employee\EmployeeRepository;
use Crm\Repositories\Invitation\InvitationRepository;
use Crm\Services\Auth\AuthenticatableService;
use Illuminate\Support\Arr;
use Illuminate\Hashing\HashManager;

class EmployeeService extends AuthenticatableService
{
    public function __construct(
        private readonly EmployeeRepository $employeeRepository,
        private readonly InvitationRepository $invitationRepository,
        private readonly HashManager $hashManager
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

    public function createFromInvitation(Invitation $invitation, array $attributes): Employee
    {
        $employee = $this->employeeRepository->create(
            [
                Employee::EMAIL_COLUMN      => $invitation->getEmail(),
                Employee::NAME_COLUMN       => $invitation->getName(),
                Employee::COMPANY_ID_COLUMN => $invitation->getCompanyId(),
                Employee::ADDRESS_COLUMN    => Arr::get($attributes, Employee::ADDRESS_COLUMN),
                Employee::PHONE_COLUMN      => Arr::get($attributes, Employee::PHONE_COLUMN),
                Employee::BIRTHDATE_COLUMN  => Arr::get($attributes, Employee::BIRTHDATE_COLUMN),
                Employee::STATUS_COLUMN     => EmployeeStatus::INACTIVE,
                Employee::PASSWORD_COLUMN   => $this->hashManager->make(
                    Arr::get($attributes, Employee::PASSWORD_COLUMN)
                ),
            ]
        );

        $this->invitationRepository->update($invitation->getId(), [Invitation::TOKEN_COLUMN => null]);

        return $employee;
    }

    public function validate(Employee $employee): bool
    {
        return $this->update($employee, [
            Employee::STATUS_COLUMN => EmployeeStatus::ACTIVE
        ]);
    }

    public function update(Employee $employee, array $attributes): bool
    {
        return $this->employeeRepository->update($employee->getId(), $attributes);
    }
}

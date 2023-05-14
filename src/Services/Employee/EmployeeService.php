<?php

namespace Crm\Services\Employee;

use App\Entities\Company\Company;
use App\Entities\Employee\Employee;
use App\Entities\History\History;
use App\Entities\Invitation\Invitation;
use App\Enums\EmployeeStatus;
use App\Enums\HistoryAction;
use App\Enums\HistoryActionableTypes;
use App\Enums\HistoryUsableTypes;
use Crm\Locators\CurrentEmployeeLocator;
use Crm\Repositories\Admin\HistoryRepository;
use Crm\Repositories\Company\CompanyRepository;
use Crm\Repositories\Employee\EmployeeRepository;
use Crm\Repositories\Invitation\InvitationRepository;
use Crm\Services\Auth\AuthenticatableService;
use Illuminate\Support\Arr;
use Illuminate\Hashing\HashManager;
use Illuminate\Support\Collection;

class EmployeeService extends AuthenticatableService
{
    public function __construct(
        private readonly EmployeeRepository $employeeRepository,
        private readonly InvitationRepository $invitationRepository,
        private readonly CompanyRepository $companyRepository,
        private readonly HashManager $hashManager,
        private readonly CurrentEmployeeLocator $employeeLocator,
        private readonly HistoryRepository $historyRepository
    ) {
    }

    public function findById(string $id): ?Employee
    {
        $employee = $this->employeeRepository->findById($id);
        if (!$employee instanceof Employee) {
            return null;
        }

        return $this->hydrate($employee);
    }

    private function hydrate(Employee $employee): Employee
    {
        $company = $this->companyRepository->findById($employee->getCompanyId());
        if (!$company instanceof Company) {
            return $employee;
        }

        return $employee->setCompany($company);
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

        $this->historyRepository->create(
            [
                History::USEABLE_ID_COLUMN      => $employee->getId(),
                History::USEABLE_TYPE_COLUMN    => HistoryUsableTypes::EMPLOYEE,
                History::USEABLE_NAME_COLUMN    => $employee->getName(),
                History::ACTION_COLUMN          => HistoryAction::CONFIRMED,
                History::ACTIONABLE_ID_COLUMN   => $invitation->getId(),
                History::ACTIONABLE_NAME_COLUMN => $invitation->getName(),
                History::ACTIONABLE_TYPE_COLUMN => HistoryActionableTypes::INVITATION,
            ]
        );

        $this->invitationRepository->update($invitation->getId(), [Invitation::TOKEN_COLUMN => null]);

        return $employee;
    }

    public function validate(Employee $employee, Invitation $invitation): bool
    {
        $this->historyRepository->create(
            [
                History::USEABLE_ID_COLUMN      => $employee->getId(),
                History::USEABLE_TYPE_COLUMN    => HistoryUsableTypes::EMPLOYEE,
                History::USEABLE_NAME_COLUMN    => $employee->getName(),
                History::ACTION_COLUMN          => HistoryAction::VALIDATES,
                History::ACTIONABLE_ID_COLUMN   => $invitation->getId(),
                History::ACTIONABLE_NAME_COLUMN => $invitation->getName(),
                History::ACTIONABLE_TYPE_COLUMN => HistoryActionableTypes::INVITATION,
            ]
        );

        return $this->update($employee, [
            Employee::STATUS_COLUMN => EmployeeStatus::ACTIVE,
        ]);
    }

    public function update(Employee $employee, array $attributes): bool
    {
        return $this->employeeRepository->update($employee->getId(), $attributes);
    }

    public function updateProfile(array $attributes): bool
    {
        $employee = $this->employeeLocator->getEmployee();

        $password = Arr::get($attributes, Employee::PASSWORD_COLUMN);
        if ($password) {
            Arr::set($attributes, Employee::PASSWORD_COLUMN, $this->hashManager->make($password));
        }

        $attributes = Collection::make($attributes)->filter(fn($item) => $item !== null);

        return $this->update($employee, $attributes->toArray());
    }
}

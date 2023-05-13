<?php

namespace Crm\Services\Auth;

use App\Entities\Employee\Employee;
use Crm\Managers\Auth\Employee\EmployeeAuthManager;
use Crm\Repositories\Employee\EmployeeRepository;
use Crm\Services\BaseService;
use Crm\Validators\Exceptions\ValidationException;
use Illuminate\Hashing\HashManager;

class EmployeeAuthService extends BaseService
{
    public function __construct(
        private readonly EmployeeAuthManager $employeeAuthManager,
        private readonly EmployeeRepository $employeeRepository,
        private readonly HashManager $passwordHashManager,
    ) {
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $rememberMe
     *
     * @return void
     * @throws ValidationException
     */
    public function authenticate(string $email, string $password, bool $rememberMe = false): void
    {
        $employee = $this->findByCredentials($email, $password);
        if (!$employee instanceof Employee) {
            throw ValidationException::withMessages(
                [
                    'email' => 'These credentials does not match our records',
                ]
            );
        }

        if ($employee->isInactive()) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Your account is still inactive yet, please contact admin for activation',
                ]
            );
        }

        $this->employeeAuthManager->login($employee, $rememberMe);
    }

    private function findByCredentials(string $email, string $password): ?Employee
    {
        $employee = $this->employeeRepository->findByEmail($email);
        if (!$employee instanceof Employee) {
            return null;
        }

        if (!$this->passwordHashManager->check($password, $employee->getPassword())) {
            return null;
        }

        return $employee;
    }
}

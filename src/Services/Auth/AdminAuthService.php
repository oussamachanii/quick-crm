<?php

namespace Crm\Services\Auth;

use App\Entities\Admin\Admin;
use Crm\Managers\Auth\Admin\AdminAuthManager;
use Crm\Repositories\Admin\AdminRepository;
use Crm\Services\BaseService;
use Crm\Validators\Exceptions\ValidationException;
use Illuminate\Hashing\HashManager;

class AdminAuthService extends BaseService
{
    public function __construct(
        private readonly AdminAuthManager $adminAuthManager,
        private readonly AdminRepository $adminRepository,
        private readonly HashManager $passwordHashManager,
    ) {
    }

    public function authenticate(string $email, string $password, bool $rememberMe = false): void
    {
        $admin = $this->findByCredentials($email, $password);
        if (!$admin instanceof Admin) {
            throw ValidationException::withMessages(
                [
                    'email' => 'These credentials does not match our records',
                ]
            );
        }

        $this->adminAuthManager->login($admin, $rememberMe);
    }

    private function findByCredentials(string $email, string $password): ?Admin
    {
        $admin = $this->adminRepository->findByEmail($email);
        if (!$admin instanceof Admin) {
            return null;
        }

        if (!$this->passwordHashManager->check($password, $admin->getPassword())) {
            return null;
        }

        return $admin;
    }
}

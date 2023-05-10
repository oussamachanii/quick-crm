<?php

namespace Crm\Managers\Auth;

use App\Entities\Authenticatable;
use Crm\Services\Auth\AuthenticatableService;
use Illuminate\Auth\AuthManager;

class BaseAuthManager
{
    protected const GUARD_NAME = 'web';

    private readonly AuthManager $authManager;

    public function __construct(
        private readonly AuthenticatableService $authService
    ) {
        $this->authManager = app(AuthManager::class);
    }

    protected function user(): ?Authenticatable
    {
        $user = $this->guard()->user();
        if (!$user instanceof Authenticatable) {
            return null;
        }

        return $this->authService->findById($user->getId());
    }

    protected function guard()
    {
        return $this->authManager->guard(self::GUARD_NAME);
    }

    protected function check(): bool
    {
        return $this->guard()->check();
    }

    protected function login(Authenticatable $authenticatable, bool $rememberMe = false): void
    {
        $this->guard()->login($authenticatable, $rememberMe);
    }
}

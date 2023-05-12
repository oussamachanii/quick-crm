<?php

namespace Crm\Managers\Auth;

use App\Entities\Authenticatable;
use Crm\Services\Auth\AuthenticatableService;
use Illuminate\Auth\AuthManager;

abstract class BaseAuthManager
{
    public const GUARD_NAME = 'web';

    protected readonly AuthManager $authManager;

    public function __construct(
        private readonly AuthenticatableService $authService
    ) {
        $this->authManager = app(AuthManager::class);
    }

    public function user(): ?Authenticatable
    {
        $user = $this->guard()->user();
        if (!$user instanceof Authenticatable) {
            return null;
        }

        return $this->authService->findById($user->getId());
    }

    abstract protected function guard();

    public function check(): bool
    {
        return $this->guard()->check();
    }

    public function login(Authenticatable $authenticatable, bool $rememberMe = false): void
    {
        $this->guard()->login($authenticatable, $rememberMe);
    }

    public function logout(): void
    {
        $this->guard()->logout();
    }
}

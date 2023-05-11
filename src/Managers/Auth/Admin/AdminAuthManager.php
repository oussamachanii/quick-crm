<?php

namespace Crm\Managers\Auth\Admin;

use Crm\Managers\Auth\BaseAuthManager;
use Crm\Services\Admin\AdminService;

class AdminAuthManager extends BaseAuthManager
{
    public const GUARD_NAME = 'admin-web';
    public const HOME_PAGE = 'admin.dashboard';

    public function __construct(
        private readonly AdminService $adminService
    ) {
        parent::__construct($this->adminService);
    }

    protected function guard()
    {
        return $this->authManager->guard(self::GUARD_NAME);
    }
}

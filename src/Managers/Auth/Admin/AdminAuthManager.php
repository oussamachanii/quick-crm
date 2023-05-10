<?php

namespace Crm\Managers\Auth\Admin;

use Crm\Managers\Auth\BaseAuthManager;
use Crm\Services\Admin\AdminService;

class AdminAuthManager extends BaseAuthManager
{
    protected const GUARD_NAME = 'admin-web';

    public function __construct(
        private readonly AdminService $adminService
    ) {
        parent::__construct($this->adminService);
    }
}

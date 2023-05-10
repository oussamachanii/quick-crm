<?php

namespace Crm\Services\Admin;

use App\Entities\Admin\Admin;
use Crm\Repositories\Admin\AdminRepository;
use Crm\Services\Auth\AuthenticatableService;

class AdminService extends AuthenticatableService
{
    public function __construct(
        readonly private AdminRepository $adminRepository
    ) {
    }

    public function findById(string $id): ?Admin
    {
        return $this->adminRepository->findById($id);
    }
}

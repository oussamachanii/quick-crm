<?php

namespace Crm\Services\Admin;

use App\Entities\Admin\Admin;
use Crm\Locators\CurrentAdminLocator;
use Crm\Repositories\Admin\AdminRepository;
use Crm\Services\Auth\AuthenticatableService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Hashing\HashManager;

class AdminService extends AuthenticatableService
{
    public function __construct(
        readonly private AdminRepository $adminRepository,
        readonly private HashManager $hashManager,
        readonly private CurrentAdminLocator $adminLocator
    ) {
    }

    public function findById(string $id): ?Admin
    {
        return $this->adminRepository->findById($id);
    }

    public function create(array $attributes): Admin
    {
        Arr::set(
            $attributes,
            Admin::PASSWORD_COLUMN,
            $this->hashManager->make(Arr::get($attributes, Admin::PASSWORD_COLUMN))
        );

        return $this->adminRepository->create($attributes);
    }

    public function getPaginated(): LengthAwarePaginator
    {
        $admin = $this->adminLocator->getAdmin();

        return $this->adminRepository->getPaginated($admin->getId());
    }
}

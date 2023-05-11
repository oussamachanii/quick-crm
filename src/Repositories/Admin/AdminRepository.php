<?php

namespace Crm\Repositories\Admin;

use App\Entities\Admin\Admin;
use Crm\Repositories\BaseRepository;

class AdminRepository extends BaseRepository
{
    public function findById(string $adminId): ?Admin
    {
        return Admin::query()
            ->where(Admin::ID_COLUMN, $adminId)
            ->first();
    }

    public function findByEmail(string $findByEmail): ?Admin
    {
        return Admin::query()
            ->where(Admin::EMAIL_COLUMN, $findByEmail)
            ->first();
    }
}

<?php

namespace Crm\Repositories\Admin;

use App\Entities\Admin\Admin;
use Crm\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

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

    public function create(array $attributes): Admin
    {
        $attributes = Arr::only($attributes,
            [
                Admin::NAME_COLUMN,
                Admin::EMAIL_COLUMN,
                Admin::PASSWORD_COLUMN
            ]
        );

        return Admin::query()
            ->create($attributes);
    }

    public function getPaginated(string $adminId): LengthAwarePaginator
    {
        return Admin::query()
            ->whereNot(Admin::ID_COLUMN, $adminId)
            ->paginate(10);
    }
}

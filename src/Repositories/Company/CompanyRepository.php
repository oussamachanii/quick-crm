<?php

namespace Crm\Repositories\Company;

use App\Entities\Company\Company;
use Crm\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class CompanyRepository extends BaseRepository
{
    public function getPaginated(string $search = null): LengthAwarePaginator
    {
        $query = Company::query()
            ->orderByDesc(Company::CREATED_AT);

        if ($search !== null) {
            $query = $query->orWhere(Company::ADDRESS_COLUMN, 'LIKE', "%".$search."%")
                ->orWhere(Company::NAME_COLUMN,'LIKE', "%".$search."%")
                ->orWhere(Company::CAPITAL_COLUMN, $search);
        }

        return $query->paginate(10)->withQueryString();
    }

    public function findById(string $id): ?Company
    {
        return Company::query()
            ->where(Company::ID_COLUMN, $id)
            ->first();
    }

    public function delete(string $id): bool
    {
        return Company::query()
            ->where(Company::ID_COLUMN, $id)
            ->delete();
    }

    public function update(string $id, array $attributes): bool
    {
        $attributes = Arr::only(
            $attributes,
            [
                Company::CAPITAL_COLUMN,
                Company::NAME_COLUMN,
                Company::ADDRESS_COLUMN,
            ]
        );

        return Company::query()
            ->where(Company::ID_COLUMN, $id)
            ->update($attributes);
    }

    public function create(array $attributes): Company
    {
        $attributes = Arr::only(
            $attributes,
            [
                Company::CAPITAL_COLUMN,
                Company::NAME_COLUMN,
                Company::ADDRESS_COLUMN,
            ]
        );

        return Company::query()
            ->create($attributes);
    }
}

<?php

namespace Crm\Repositories\Invitation;

use App\Entities\Invitation\Invitation;
use Crm\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class InvitationRepository extends BaseRepository
{
    public function getPaginated(string $search = null): LengthAwarePaginator
    {
        $query = Invitation::query()
            ->orderByDesc(Invitation::CREATED_AT);

        if ($search !== null) {
            $query = $query->orWhere(Invitation::EMAIL_COLUMN, 'LIKE', "%" . $search . "%")
                ->orWhere(Invitation::NAME_COLUMN, 'LIKE', "%" . $search . "%");
        }

        return $query->paginate(10);
    }

    public function findById(string $id): ?Invitation
    {
        return Invitation::query()
            ->where(Invitation::ID_COLUMN, $id)
            ->first();
    }

    public function findByEmail(string $email): ?Invitation
    {
        return Invitation::query()
            ->where(Invitation::EMAIL_COLUMN, $email)
            ->first();
    }

    public function findByToken(string $token): ?Invitation
    {
        return Invitation::query()
            ->where(Invitation::TOKEN_COLUMN, $token)
            ->first();
    }

    public function delete(string $id): bool
    {
        return Invitation::query()
            ->where(Invitation::ID_COLUMN, $id)
            ->delete();
    }

    public function create(array $attributes): Invitation
    {
        $attributes = Arr::only(
            $attributes,
            [
                Invitation::EMAIL_COLUMN,
                Invitation::NAME_COLUMN,
                Invitation::ADMIN_ID_COLUMN,
                Invitation::COMPANY_ID_COLUMN,
            ]
        );

        Arr::set($attributes, Invitation::TOKEN_COLUMN, Str::random(12));

        return Invitation::query()
            ->create($attributes);
    }

    public function update(string $id, array $attributes): bool
    {
        $attributes = Arr::only(
            $attributes,
            [
                Invitation::EMAIL_COLUMN,
                Invitation::NAME_COLUMN,
                Invitation::ADMIN_ID_COLUMN,
                Invitation::COMPANY_ID_COLUMN,
                Invitation::TOKEN_COLUMN,
            ]
        );

        return Invitation::query()
            ->where(Invitation::ID_COLUMN, $id)
            ->update($attributes);
    }
}

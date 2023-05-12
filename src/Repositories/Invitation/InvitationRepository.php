<?php

namespace Crm\Repositories\Invitation;

use App\Entities\Invitation\Invitation;
use Crm\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class InvitationRepository extends BaseRepository
{
    public function getPaginated(string $search = null): LengthAwarePaginator
    {
        $query = Invitation::query()
            ->orderByDesc(Invitation::CREATED_AT);

        if ($search !== null) {
            $query = $query->orWhere(Invitation::EMAIL_COLUMN, 'LIKE', "%".$search."%")
                ->orWhere(Invitation::NAME_COLUMN,'LIKE', "%".$search."%");
        }

        return $query->paginate(10);
    }
}

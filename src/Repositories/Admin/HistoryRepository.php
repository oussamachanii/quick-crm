<?php

namespace Crm\Repositories\Admin;

use App\Entities\History\History;
use Carbon\Carbon;
use Crm\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class HistoryRepository extends BaseRepository
{
    public function create(array $attributes): History
    {
        // This action can be queueable
        $attributes = Arr::only(
            $attributes,
            [
                History::USEABLE_TYPE_COLUMN,
                History::USEABLE_ID_COLUMN,
                History::USEABLE_NAME_COLUMN,
                History::ACTION_COLUMN,
                History::ACTIONABLE_ID_COLUMN,
                History::ACTIONABLE_TYPE_COLUMN,
                History::ACTIONABLE_NAME_COLUMN,
            ]
        );

        Arr::set($attributes, History::CREATED_AT, Carbon::now());

        return History::query()
            ->create($attributes);
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return History::query()
            ->paginate(10);
    }
}

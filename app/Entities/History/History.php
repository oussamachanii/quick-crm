<?php

namespace App\Entities\History;

use App\Entities\Model;
use App\Enums\HistoryAction;
use App\Enums\HistoryActionableTypes;
use App\Enums\HistoryUsableTypes;
use Carbon\Carbon;

class History extends Model
{
    public const TABLE_NAME = 'histories';

    // Columns
    public const USEABLE_TYPE_COLUMN = 'usable_type';
    public const USEABLE_ID_COLUMN = 'usable_id';
    public const USEABLE_NAME_COLUMN = 'usable_name';
    public const ACTION_COLUMN = 'action';
    public const ACTIONABLE_ID_COLUMN = 'actionable_id';
    public const ACTIONABLE_TYPE_COLUMN = 'actionable_type';
    public const ACTIONABLE_NAME_COLUMN = 'actionable_name';

    private ?string $message;

    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        self::ACTION_COLUMN          => HistoryAction::class,
        self::USEABLE_TYPE_COLUMN    => HistoryUsableTypes::class,
        self::ACTIONABLE_TYPE_COLUMN => HistoryActionableTypes::class,
        self::CREATED_AT             => 'datetime',
    ];


    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT);
    }

    public function getUseableType(): string
    {
        return $this->getAttribute(self::USEABLE_TYPE_COLUMN);
    }

    public function getUseableName(): string
    {
        return $this->getAttribute(self::USEABLE_NAME_COLUMN);
    }

    public function getUseableId(): string
    {
        return $this->getAttribute(self::USEABLE_ID_COLUMN);
    }

    public function getAction(): HistoryAction
    {
        return $this->getAttribute(self::ACTION_COLUMN);
    }

    public function getActionableType(): string
    {
        return $this->getAttribute(self::ACTIONABLE_TYPE_COLUMN);
    }

    public function getActionableName(): string
    {
        return $this->getAttribute(self::ACTIONABLE_NAME_COLUMN);
    }

    public function getActionableId(): ?string
    {
        return $this->getAttribute(self::ACTIONABLE_ID_COLUMN);
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}

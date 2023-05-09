<?php

namespace App\Entities;

use App\Observers\ModelUuidObserver;
use Carbon\Carbon;

abstract class ModelUuid extends Model
{
    public const ID_COLUMN = 'id';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Override the primary key type.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     *  Setup model event hooks.
     */
    protected static function boot()
    {
        parent::boot();

        self::observe(ModelUuidObserver::class);
    }

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT);
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->getAttribute(self::UPDATED_AT);
    }
}

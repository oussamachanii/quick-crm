<?php

namespace App\Entities\Admin;

use App\Entities\Authenticatable;

class Admin extends Authenticatable
{
    public const TABLE_NAME = 'admins';

    // Columns
    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const PASSWORD_COLUMN = 'password';

    protected $guarded = [];

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getEmail(): string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getPassword(): string
    {
        return $this->getAttribute(self::PASSWORD_COLUMN);
    }
}

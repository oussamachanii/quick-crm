<?php

namespace App\Entities\Invitation;

use App\Entities\ModelUuid;

class Invitation extends ModelUuid
{
    public const TABLE_NAME = 'invitations';

    // Columns
    public const EMAIL_COLUMN = 'email';
    public const TOKEN_COLUMN = 'token';
    public const ADMIN_ID_COLUMN = 'admin_id';

    public function getEmail(): string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getToken(): ?string
    {
        return $this->getAttribute(self::TOKEN_COLUMN);
    }

    public function getAdminId(): string
    {
        return $this->getAttribute(self::ADMIN_ID_COLUMN);
    }

    public function isConfirmed(): bool
    {
        return $this->getToken() === null;
    }
}

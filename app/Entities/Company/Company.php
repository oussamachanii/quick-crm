<?php

namespace App\Entities\Company;

use App\Entities\ModelUuid;

class Company extends ModelUuid
{
    public const TABLE_NAME = 'companies';

    // Columns
    public const NAME_COLUMN = 'name';
    public const ADDRESS_COLUMN = 'address';
    public const CAPITAL_COLUMN = 'capital';

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getAddress(): string
    {
        return $this->getAttribute(self::ADDRESS_COLUMN);
    }

    public function getCapital(): ?int
    {
        return $this->getAttribute(self::CAPITAL_COLUMN);
    }
}

<?php

namespace App\Entities\Employee;

use App\Entities\ModelUuid;
use App\Enums\EmployeeStatus;
use Carbon\Carbon;

class Employee extends ModelUuid
{
    public const TABLE_NAME = 'employees';

    // Columns
    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const ADDRESS_COLUMN = 'address';
    public const PHONE_COLUMN = 'phone';
    public const BIRTHDATE_COLUMN = 'birthdate';
    public const COMPANY_ID_COLUMN = 'company_id';
    public const STATUS_COLUMN = 'status';
    public const PASSWORD_COLUMN = 'password';

    protected $guarded = [];

    protected $casts = [
        self::STATUS_COLUMN    => EmployeeStatus::class,
        self::BIRTHDATE_COLUMN => 'datetime',
    ];

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getAddress(): string
    {
        return $this->getAttribute(self::ADDRESS_COLUMN);
    }

    public function getEmail(): string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getPhone(): string
    {
        return $this->getAttribute(self::PHONE_COLUMN);
    }

    public function getBirthDate(): Carbon
    {
        return $this->getAttribute(self::BIRTHDAY_COLUMN);
    }

    public function getCompanyId(): string
    {
        return $this->getAttribute(self::COMPANY_ID_COLUMN);
    }

    public function getStatus(): EmployeeStatus
    {
        return $this->getAttribute(self::STATUS_COLUMN);
    }

    public function getPassword(): string
    {
        return $this->getAttribute(self::PASSWORD_COLUMN);
    }
}

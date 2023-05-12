<?php

namespace App\Entities\Invitation;

use App\Entities\Admin\Admin;
use App\Entities\Company\Company;
use App\Entities\Employee\Employee;
use App\Entities\ModelUuid;

class Invitation extends ModelUuid
{
    public const TABLE_NAME = 'invitations';

    // Columns
    public const EMAIL_COLUMN = 'email';
    public const NAME_COLUMN = 'name';
    public const TOKEN_COLUMN = 'token';
    public const ADMIN_ID_COLUMN = 'admin_id';
    public const COMPANY_ID_COLUMN = 'company_id';

    private ?Company $company = null;
    private ?Admin $admin = null;
    private ?Employee $employee = null;

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

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


    public function getCompanyId(): string
    {
        return $this->getAttribute(self::COMPANY_ID_COLUMN);
    }

    public function isAccepted(): bool
    {
        return $this->getToken() === null;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function setAdmin(Admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}

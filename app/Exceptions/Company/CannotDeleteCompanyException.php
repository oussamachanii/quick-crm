<?php

namespace App\Exceptions\Company;

use App\Entities\Company\Company;
use Exception;

class CannotDeleteCompanyException extends Exception
{
    public function __construct(
        private readonly Company $company,
        string $message = "Cannot delete company"
    ) {
        parent::__construct($message);
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }
}

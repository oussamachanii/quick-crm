<?php

namespace Crm\Locators;


use App\Entities\Employee\Employee;

class CurrentEmployeeLocator
{
    private ?Employee $employee;

    /**
     * @return Employee|null
     */
    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     *
     * @return $this
     */
    public function setEmployee(Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}

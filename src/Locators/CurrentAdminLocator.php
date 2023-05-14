<?php

namespace Crm\Locators;

use App\Entities\Admin\Admin;

class CurrentAdminLocator
{
    private ?Admin $admin;

    /**
     * @return Admin|null
     */
    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    /**
     * @param Admin $admin
     *
     * @return $this
     */public function setAdmin(Admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
}

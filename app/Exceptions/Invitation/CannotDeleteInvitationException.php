<?php

namespace App\Exceptions\Invitation;

use App\Entities\Invitation\Invitation;
use Exception;

class CannotDeleteInvitationException extends Exception
{
    public function __construct(
        private readonly Invitation $invitation,
        string $message = "Cannot delete invitation"
    ) {
        parent::__construct($message);
    }

    /**
     * @return Invitation
     */
    public function getInvitation(): Invitation
    {
        return $this->invitation;
    }
}

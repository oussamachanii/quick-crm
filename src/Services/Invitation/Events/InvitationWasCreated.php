<?php

namespace Crm\Services\Invitation\Events;

use App\Entities\Invitation\Invitation;
use Crm\Services\Invitation\InvitationService;
use Illuminate\Support\Facades\Event;

class InvitationWasCreated extends Event
{
    private Invitation $invitation;

    public function __construct(
        private readonly string $invitationId,
    ) {
        $this->setModels();
    }

    private function setModels()
    {
        /** @var InvitationService $invitationService */
        $invitationService = app(InvitationService::class);
        $invitation = $invitationService->findById($this->invitationId);
        $this->setInvitation($invitation);
    }

    public function __sleep(): array
    {
        return ['invitationId'];
    }

    public function __wakeup(): void
    {
        $this->setModels();
    }

    public function getInvitation(): Invitation
    {
        return $this->invitation;
    }

    public function setInvitation(Invitation $invitation): void
    {
        $this->invitation = $invitation;
    }
}

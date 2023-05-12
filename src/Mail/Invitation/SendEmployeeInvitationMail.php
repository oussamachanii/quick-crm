<?php

namespace Crm\Mail\Invitation;

use App\Entities\Invitation\Invitation;
use Crm\Services\Invitation\InvitationService;
use Illuminate\Mail\Mailable;

class SendEmployeeInvitationMail extends Mailable
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

    public function build(): SendEmployeeInvitationMail
    {
        return $this
            ->from($this->getInvitation()->getAdmin()->getEmail())
            ->to($this->getInvitation()->getEmail())
            ->view('emails.invitations.invite')
            ->subject('Workspace invitation')
            ->with(
                [
                    'invitation' => $this->getInvitation(),
                    'link'       => route('invitation.connect', $this->getInvitation()->getToken()),
                ]
            );
    }
}

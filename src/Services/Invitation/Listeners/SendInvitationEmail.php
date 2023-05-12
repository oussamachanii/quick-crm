<?php

namespace Crm\Services\Invitation\Listeners;

use Crm\Mail\Invitation\SendEmployeeInvitationMail;
use Crm\Services\Invitation\Events\InvitationWasCreated;
use Crm\Services\Invitation\InvitationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Throwable;
use Illuminate\Mail\Mailer;

class SendInvitationEmail implements ShouldQueue
{
    use Queueable;

    public function __construct(
        readonly private InvitationService $invitationService,
        readonly private Mailer $mailer,
    ) {
    }

    public function handle(InvitationWasCreated $event)
    {
        try {
            // Log here
            $this->mailer->send(new SendEmployeeInvitationMail($event->getInvitation()->getId()));
        } catch (Throwable $e) {
            // Log error here.
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Invitation;

use App\Entities\Invitation\Invitation;
use Crm\Services\Invitation\InvitationService;
use Illuminate\Routing\Controller as BaseController;
use Throwable;

class ConnectInvitationController extends BaseController
{
    public function __construct(
        readonly private InvitationService $invitationService
    ) {
    }

    public function __invoke(string $token)
    {
        try {
            $invitation = $this->invitationService->findByToken($token);
            if (!$invitation instanceof Invitation) {
                return redirect()
                    ->route('home')
                    ->withErrors('Invitation is not valid');
            }

            return view('employee.pages.create', [
                'invitation' => $invitation,
            ]);
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

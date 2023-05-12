<?php

namespace App\Http\Controllers\Admin\Invitation;

use App\Entities\Invitation\Invitation;
use App\Exceptions\Invitation\CannotDeleteInvitationException;
use App\Http\Controllers\Admin\BaseAdminController;
use Crm\Services\Invitation\invitationService;
use Throwable;

class DeleteInvitationController extends BaseAdminController
{
    public function __construct(
        readonly private invitationService $invitationService
    ) {
        parent::__construct();
    }

    public function __invoke(string $id)
    {
        try {
            $invitation = $this->invitationService->findById($id);
            if (!$invitation instanceof Invitation) {
                return redirect()
                    ->back()
                    ->withErrors('invitation could not be found');
            }

            $this->invitationService->delete($invitation);

            return redirect()
                ->route('admin.invitation.index')
                ->with('success', 'Invitation is successfully deleted');
        } catch (CannotDeleteInvitationException $e) {
            return redirect()
                ->back()
                ->withErrors($e);
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

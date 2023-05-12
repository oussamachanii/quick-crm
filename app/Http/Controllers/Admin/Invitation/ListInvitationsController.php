<?php

namespace App\Http\Controllers\Admin\Invitation;

use App\Http\Controllers\Admin\BaseAdminController;
use Crm\Services\Invitation\invitationService;
use Illuminate\Http\Request;
use Throwable;

class ListInvitationsController extends BaseAdminController
{
    public function __construct(
        readonly private invitationService $invitationService
    ) {
        parent::__construct();
    }

    public function __invoke(Request $request)
    {
        try {
            $invitations = $this->invitationService->getPaginated($request->query('search'));

            return $this->view('admin.pages.invitation.index', [
                'invitations' => $invitations,
                'query'       => $request->query('search'),
            ]);
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

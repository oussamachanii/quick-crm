<?php

namespace App\Http\Controllers\Admin\Invitation;

use App\Entities\Invitation\Invitation;
use App\Exceptions\Invitation\CannotDeleteInvitationException;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Invitation\StoreInvitationRequest;
use Crm\Services\Invitation\InvitationService;
use Throwable;

class StoreInvitationController extends BaseAdminController
{
    public function __construct(
        readonly private InvitationService $invitationService
    ) {
        parent::__construct();
    }

    public function __invoke(StoreInvitationRequest $request)
    {
        try {
            $attributes = [
                Invitation::COMPANY_ID_COLUMN => $request->get('company_id'),
                Invitation::NAME_COLUMN       => $request->get('name'),
                Invitation::EMAIL_COLUMN      => $request->get('email'),
                Invitation::ADMIN_ID_COLUMN   => $this->getCurrentAdmin()->getId(),
            ];

            $this->invitationService->create($attributes);

            return redirect()
                ->route('admin.company.index')
                ->with('success', 'Company is successfully updated');
        } catch (CannotDeleteInvitationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage());
        } catch (Throwable $e) {
            dd($e);
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

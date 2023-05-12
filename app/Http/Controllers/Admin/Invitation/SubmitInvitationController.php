<?php

namespace App\Http\Controllers\Admin\Invitation;

use App\Entities\Employee\Employee;
use App\Entities\Invitation\Invitation;
use App\Http\Requests\Invitation\SubmitInvitationRequest;
use Crm\Services\Employee\EmployeeService;
use Crm\Services\Invitation\InvitationService;
use Illuminate\Routing\Controller as BaseController;
use Throwable;

class SubmitInvitationController extends BaseController
{
    public function __construct(
        readonly private InvitationService $invitationService,
        readonly private EmployeeService $employeeService
    ) {
    }

    public function __invoke(SubmitInvitationRequest $request)
    {
        try {
            $invitation = $this->invitationService->findByToken($request->get('token'));
            if (!$invitation instanceof Invitation) {
                return redirect()
                    ->route('home')
                    ->withErrors('Invitation is not valid');
            }

            $employee = $this->employeeService->findByEmail($invitation->getEmail());
            if ($employee instanceof Employee) {
                return redirect()
                    ->back()
                    ->withErrors('Employee already invited');
            }

            $employee = $this->employeeService->createFromInvitation($invitation, $request->validated());

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

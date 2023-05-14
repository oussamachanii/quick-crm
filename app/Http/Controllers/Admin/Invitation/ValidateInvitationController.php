<?php

namespace App\Http\Controllers\Admin\Invitation;

use App\Entities\Employee\Employee;
use App\Entities\Invitation\Invitation;
use Crm\Services\Employee\EmployeeService;
use Crm\Services\Invitation\InvitationService;
use Illuminate\Routing\Controller as BaseController;
use Throwable;

class ValidateInvitationController extends BaseController
{
    public function __construct(
        readonly private InvitationService $invitationService,
        readonly private EmployeeService $employeeService,
    ) {
    }

    public function __invoke(string $id)
    {
        try {
            $invitation = $this->invitationService->findById($id);
            if (!$invitation instanceof Invitation) {
                return redirect()
                    ->route('home')
                    ->withErrors('Invitation is not valid');
            }

            $employee = $this->employeeService->findByEmail($invitation->getEmail());
            if (!$employee instanceof Employee) {
                return redirect()
                    ->route('home')
                    ->withErrors('Employee could not found');
            }

            $this->employeeService->validate($employee, $invitation);

            return redirect()
                ->back()
                ->with('success', 'Employee is successfully validated');
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

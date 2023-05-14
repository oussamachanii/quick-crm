<?php

namespace App\Http\Controllers\Employee\Dashboard;

use App\Http\Controllers\Employee\BaseEmployeeController;
use App\Http\Requests\Employee\UpdateProfileRequest;
use Crm\Services\Employee\EmployeeService;
use Throwable;

class UpdateProfileController extends BaseEmployeeController
{
    public function __construct(
        readonly private EmployeeService $employeeService
    ) {
        parent::__construct();
    }

    public function __invoke(UpdateProfileRequest $request)
    {
        try {
            $this->employeeService->updateProfile($this->getCurrentEmployee(), $request->validated());

            return redirect()
                ->back()
                ->with('success', 'Profile is successfully updated');
        } catch (Throwable $e) {
            // Log the error here
            return redirect()
                ->back()
                ->withErrors('an error has been occurred');
        }
    }
}

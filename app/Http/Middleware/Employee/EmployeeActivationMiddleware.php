<?php

namespace App\Http\Middleware\Employee;

use App\Entities\Employee\Employee;
use Crm\Managers\Auth\Employee\EmployeeAuthManager;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Http\Response;

class EmployeeActivationMiddleware
{
    public function __construct(
        private readonly EmployeeAuthManager $employeeAuthManager
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        $employee = $this->employeeAuthManager->user();
        if (!$employee instanceof Employee || $employee->isInactive()) {
            return redirect()
                ->route('employee.auth.login.show');
        }

        abort_unless($employee->isActive(), Response::HTTP_UNAUTHORIZED);

        return $next($request);
    }
}

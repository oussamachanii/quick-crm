<?php

namespace App\Http\Middleware\Employee;

use App\Entities\Employee\Employee;
use Crm\Locators\CurrentEmployeeLocator;
use Crm\Managers\Auth\Employee\EmployeeAuthManager;
use Illuminate\Http\Request;
use Closure;

class AuthenticatedMiddleware
{
    public function __construct(
        private readonly EmployeeAuthManager $employeeAuthManager,
        private readonly CurrentEmployeeLocator $employeeLocator
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        // This middlewares can have a sort o abstraction, just like the auth managers
        $employee = $this->employeeAuthManager->user();
        if (!$employee instanceof Employee) {
            return redirect()
                ->route('employee.auth.login.show');
        }

        // Can be isolated into its own middleware
        $this->employeeLocator->setEmployee($employee);

        return $next($request);
    }
}

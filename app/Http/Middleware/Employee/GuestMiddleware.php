<?php

namespace App\Http\Middleware\Employee;

use App\Entities\Employee\Employee;
use Crm\Managers\Auth\Employee\EmployeeAuthManager;
use Illuminate\Http\Request;
use Closure;

class GuestMiddleware
{
    public function __construct(
        private readonly EmployeeAuthManager $employeeAuthManager
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        $employee = $this->employeeAuthManager->user();
        if ($employee instanceof Employee) {
            return redirect()
                ->route(EmployeeAuthManager::HOME_PAGE);
        }

        return $next($request);
    }
}

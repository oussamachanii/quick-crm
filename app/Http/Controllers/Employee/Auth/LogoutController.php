<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Crm\Managers\Auth\Employee\EmployeeAuthManager;
use Throwable;

class LogoutController extends Controller
{
    public function __construct(
        private readonly EmployeeAuthManager $employeeAuthManager
    ) {
        parent::__construct();
    }

    public function __invoke()
    {
        try {
            $this->employeeAuthManager->logout();

            return redirect()
                ->route('welcome');
        } catch (Throwable $e) {
            // Log here
            return redirect()
                ->back()
                ->withErrors('an error occurred');
        }
    }
}

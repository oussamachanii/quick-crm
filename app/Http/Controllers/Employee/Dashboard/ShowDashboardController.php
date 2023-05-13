<?php

namespace App\Http\Controllers\Employee\Dashboard;

use App\Http\Controllers\Employee\BaseEmployeeController;
use Throwable;

class ShowDashboardController extends BaseEmployeeController
{
    public function __invoke()
    {
        try {
            return $this->view('employee.pages.dashboard');
        } catch (Throwable $e) {
            // Log the error here
            return redirect()
                ->back()
                ->withErrors('could not show login page');
        }
    }
}

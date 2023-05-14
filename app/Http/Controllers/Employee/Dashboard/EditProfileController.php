<?php

namespace App\Http\Controllers\Employee\Dashboard;

use App\Http\Controllers\Employee\BaseEmployeeController;

use Throwable;

class EditProfileController extends BaseEmployeeController
{
    public function __invoke()
    {
        try {
            return $this->view('employee.pages.update');
        } catch (Throwable $e) {
            // Log the error here
            return redirect()
                ->back()
                ->withErrors('an error has been occurred');
        }
    }
}

<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Throwable;

class ShowLoginController extends Controller
{
    public function __invoke()
    {
        try {
            return $this->view('employee.auth.login.show');
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('could not show login page');
        }
    }
}

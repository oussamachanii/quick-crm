<?php

namespace App\Exceptions\Employee\Auth;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class EmployeeNotLoggedInException extends Exception
{
    public function __construct(
        ?string $message = 'no employee is currently logged in',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request)
    {
        session()->invalidate();

        return view('employee.auth.login.show')
            ->with('error', $this->getMessage());
    }
}

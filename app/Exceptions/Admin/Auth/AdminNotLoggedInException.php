<?php

namespace App\Exceptions\Admin\Auth;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class AdminNotLoggedInException extends Exception
{
    public function __construct(
        ?string $message = 'no admin is currently logged in',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request)
    {
        session()->invalidate();

        return view('admin.auth.login.show')
            ->with('error', $this->getMessage());
    }
}

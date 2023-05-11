<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Throwable;

class ShowLoginController extends Controller
{
    public function __invoke()
    {
        try {
            return $this->view('admin.auth.login.show');
        } catch (Throwable $e) {
            // Log the error here
            return redirect()
                ->back()
                ->withErrors('could not show login page');
        }
    }
}

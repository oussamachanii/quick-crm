<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\BaseAdminController;
use Throwable;

class LogoutController extends BaseAdminController
{

    public function __invoke()
    {
        try {
            $this->adminAuthManager->logout();

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

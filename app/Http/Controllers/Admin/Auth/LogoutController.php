<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Crm\Managers\Auth\Admin\AdminAuthManager;
use Throwable;

class LogoutController extends Controller
{
    public function __construct(
        private readonly AdminAuthManager $adminAuthManager
    ) {
        parent::__construct();
    }

    public function __invoke()
    {
        try {
            $this->adminAuthManager->logout();

            return redirect()
                ->route('admin.auth.login.show');
        } catch (Throwable $e) {
            // Log here
            return redirect()
                ->back()
                ->withErrors('an error occurred');
        }
    }
}

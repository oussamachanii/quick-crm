<?php

namespace App\Http\Middleware\Admin;

use App\Entities\Admin\Admin;
use Crm\Locators\CurrentAdminLocator;
use Crm\Managers\Auth\Admin\AdminAuthManager;
use Illuminate\Http\Request;
use Closure;

class AuthenticatedMiddleware
{
    public function __construct(
        private readonly AdminAuthManager $adminAuthManager,
        private readonly CurrentAdminLocator $currentAdminLocator
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        $admin = $this->adminAuthManager->user();
        if (!$admin instanceof Admin) {
            return redirect()
                ->route('admin.auth.login.show');
        }

        // Can be isolated into its own middleware
        $this->currentAdminLocator->setAdmin($admin);

        return $next($request);
    }
}

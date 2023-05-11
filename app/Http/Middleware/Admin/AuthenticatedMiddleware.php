<?php

namespace App\Http\Middleware\Admin;

use App\Entities\Admin\Admin;
use Crm\Managers\Auth\Admin\AdminAuthManager;
use Illuminate\Http\Request;
use Closure;

class AuthenticatedMiddleware
{
    public function __construct(
        private readonly AdminAuthManager $adminAuthManager
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        $admin = $this->adminAuthManager->user();
        if (!$admin instanceof Admin) {
            return redirect()
                ->route('admin.auth.login.show');
        }

        return $next($request);
    }
}

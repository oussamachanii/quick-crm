<?php

namespace App\Http\Middleware\Admin;

use App\Entities\Admin\Admin;
use Crm\Managers\Auth\Admin\AdminAuthManager;
use Illuminate\Http\Request;
use Closure;

class GuestMiddleware
{
    public function __construct(
        private readonly AdminAuthManager $adminAuthManager
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        $admin = $this->adminAuthManager->user();
        if ($admin instanceof Admin) {
            return redirect()
                ->route(AdminAuthManager::HOME_PAGE);
        }

        return $next($request);
    }
}

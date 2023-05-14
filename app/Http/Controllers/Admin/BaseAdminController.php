<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Admin\Admin;
use App\Exceptions\Admin\Auth\AdminNotLoggedInException;
use Crm\Managers\Auth\Admin\AdminAuthManager;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BaseAdminController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected readonly AdminAuthManager $adminAuthManager;
    public function __construct(
    ) {
        $this->adminAuthManager = app(AdminAuthManager::class);
    }

    public function view(string $view, array $data = [])
    {
        // Base information can be added here. Locale, Country, .....
        return view(
            $view,
            array_merge(
                $data,
                [
                    'admin' => $this->getCurrentAdmin(),
                ]
            )
        );
    }

    public function getCurrentAdmin(): Admin
    {
        $admin = $this->adminAuthManager->user();

        if (!$admin instanceof Admin) {
            // We can globally catch this exception and redirect to the login page
            throw new AdminNotLoggedInException();
        }

        return $admin;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Crm\Services\Admin\AdminService;
use Throwable;


class ListAdminsController extends BaseAdminController
{
    public function __construct(
        readonly private AdminService $adminService
    )
    {
        parent::__construct();
    }

    public function __invoke()
    {
        try {
            $admins = $this->adminService->getPaginated();

            return $this->view('admin.pages.index', [
                'admins' => $admins
            ]);
        } catch (Throwable $e) {
            // Log here
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreAdminRequest;
use Crm\Services\Admin\AdminService;
use Throwable;

class StoreAdminController extends BaseAdminController
{
    public function __construct(
        readonly private AdminService $adminService
    ) {
        parent::__construct();
    }

    public function __invoke(StoreAdminRequest $request)
    {
        try {
            $this->adminService->create($request->validated());

            return redirect()
                ->route('admin.index')
                ->with('success', 'admin is successfully created');
        } catch (Throwable $e) {
            // Log here
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

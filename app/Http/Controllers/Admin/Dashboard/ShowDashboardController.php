<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\BaseAdminController;
use Throwable;

class ShowDashboardController extends BaseAdminController
{
    public function __invoke()
    {
        try {
            return $this->view('admin.pages.dashboard');
        } catch (Throwable $e) {
            // Log the error here
            return redirect()
                ->back()
                ->withErrors('an error has been occurred');
        }
    }
}

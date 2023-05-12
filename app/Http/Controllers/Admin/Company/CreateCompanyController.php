<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Admin\BaseAdminController;
use Throwable;

class CreateCompanyController extends BaseAdminController
{
    public function __invoke()
    {
        try {
            return $this->view('admin.pages.company.create');
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

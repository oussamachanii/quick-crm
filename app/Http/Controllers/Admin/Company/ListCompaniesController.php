<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Admin\BaseAdminController;
use Crm\Services\Company\CompanyService;
use Illuminate\Http\Request;
use Throwable;

class ListCompaniesController extends BaseAdminController
{
    public function __construct(
        readonly private CompanyService $companyService
    ) {
        parent::__construct();
    }

    public function __invoke(Request $request)
    {
        try {
            $companies = $this->companyService->getPaginated($request->query('search'));

            return $this->view('admin.pages.company.index', [
                'companies' => $companies,
                'query'     => $request->query('search'),
            ]);
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

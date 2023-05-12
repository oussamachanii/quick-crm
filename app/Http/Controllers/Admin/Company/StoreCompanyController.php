<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Company\StoreCompanyRequest;
use Crm\Services\Company\CompanyService;
use Throwable;

class StoreCompanyController extends BaseAdminController
{
    public function __construct(
        readonly private CompanyService $companyService
    ) {
        parent::__construct();
    }

    public function __invoke(StoreCompanyRequest $request)
    {
        try {
            $this->companyService->create($request->validated());

            return redirect()
                ->route('admin.company.index')
                ->with('success', 'Company is successfully updated');
        } catch (Throwable $e) {
            dd($e);
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Company;

use App\Entities\Company\Company;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Company\UpdateCompanyRequest;
use Crm\Services\Company\CompanyService;
use Throwable;

class UpdateCompanyController extends BaseAdminController
{
    public function __construct(
        readonly private CompanyService $companyService
    ) {
        parent::__construct();
    }

    public function __invoke(string $id, UpdateCompanyRequest $request)
    {
        try {
            $company = $this->companyService->findById($id);
            if (!$company instanceof Company) {
                return redirect()
                    ->back()
                    ->withErrors('company not found');
            }

            $this->companyService->update($company, $request->validated());

            return redirect()
                ->route('admin.company.edit', $company->getId())
                ->with('success', 'Company is successfully updated');
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

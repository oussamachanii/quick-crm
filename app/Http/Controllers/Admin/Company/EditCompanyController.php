<?php

namespace App\Http\Controllers\Admin\Company;

use App\Entities\Company\Company;
use App\Http\Controllers\Admin\BaseAdminController;
use Crm\Services\Company\CompanyService;
use Throwable;

class EditCompanyController extends BaseAdminController
{
    public function __construct(
        readonly private CompanyService $companyService
    ) {
        parent::__construct();
    }

    public function __invoke(string $id)
    {
        try {
            $company = $this->companyService->findById($id);
            if (!$company instanceof Company) {
                return redirect()
                    ->back()
                    ->withErrors('company not found');
            }

            return $this->view('admin.pages.company.edit', [
                'company' => $company,
            ]);
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

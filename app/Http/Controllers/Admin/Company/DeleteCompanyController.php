<?php

namespace App\Http\Controllers\Admin\Company;

use App\Entities\Company\Company;
use App\Exceptions\Company\CannotDeleteCompanyException;
use App\Http\Controllers\Admin\BaseAdminController;
use Crm\Services\Company\CompanyService;
use Throwable;

class DeleteCompanyController extends BaseAdminController
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
            if (! $company instanceof Company) {
                return redirect()
                    ->back()
                    ->withErrors('company not found');
            }

            $this->companyService->delete($company);

            return redirect()
                ->route('admin.company.index')
                ->with('success', 'company is successfully deleted');
        } catch (CannotDeleteCompanyException $e) {
            return redirect()
                ->back()
                ->withErrors($e);
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

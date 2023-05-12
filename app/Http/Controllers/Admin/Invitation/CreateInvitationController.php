<?php

namespace App\Http\Controllers\Admin\Invitation;

use App\Http\Controllers\Admin\BaseAdminController;
use Crm\Services\Company\CompanyService;
use Throwable;

class CreateInvitationController extends BaseAdminController
{
    public function __construct(
        readonly private CompanyService $companyService
    ) {
        parent::__construct();
    }

    public function __invoke()
    {
        try {
            $companies = $this->companyService->getAll();

            return $this->view('admin.pages.invitation.create', [
                'companies' => $companies,
            ]);
        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}

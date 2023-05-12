<?php

namespace Crm\Services\Invitation;

use App\Entities\Admin\Admin;
use App\Entities\Company\Company;
use App\Entities\Employee\Employee;
use App\Entities\Invitation\Invitation;
use App\Exceptions\Invitation\CannotDeleteInvitationException;
use Crm\Repositories\Admin\AdminRepository;
use Crm\Repositories\Company\CompanyRepository;
use Crm\Repositories\Employee\EmployeeRepository;
use Crm\Repositories\Invitation\InvitationRepository;
use Crm\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class InvitationService extends BaseService
{
    public function __construct(
        readonly private InvitationRepository $invitationRepository,
        readonly private CompanyRepository $companyRepository,
        readonly private AdminRepository $adminRepository,
        readonly private EmployeeRepository $employeeRepository
    ) {
    }

    public function getPaginated(string $search = null): LengthAwarePaginator
    {
        $paginated = $this->invitationRepository->getPaginated($search);
        $invitations = $paginated->getCollection();

        return $paginated->setCollection(
            $invitations->map(fn(Invitation $invitation) => $this->hydrate($invitation))
        );
    }

    private function hydrate(Invitation $invitation): Invitation
    {
        $admin = $this->adminRepository->findById($invitation->getAdminId());
        if ($admin instanceof Admin) {
            $invitation->setAdmin($admin);
        }

        $company = $this->companyRepository->findById($invitation->getCompanyId());
        if ($company instanceof Company) {
            $invitation->setCompany($company);
        }

        $employee = $this->employeeRepository->findByEmail($invitation->getEmail());
        if ($employee instanceof Employee) {
            $invitation->setEmployee($employee);
        }

        return $invitation;
    }

    public function findById(string $id): ?Invitation
    {
        return $this->invitationRepository->findById($id);
    }

    /**
     * @param Invitation $invitation
     *
     * @return bool
     * @throws CannotDeleteInvitationException
     */
    public function delete(Invitation $invitation): bool
    {
        if ($invitation->isAccepted()) {
            throw new CannotDeleteInvitationException($invitation, 'invitation is already accepted');
        }

        return $this->invitationRepository->delete($invitation->getId());
    }
}

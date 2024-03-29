<?php

namespace Crm\Services\Invitation;

use App\Entities\Admin\Admin;
use App\Entities\Company\Company;
use App\Entities\Employee\Employee;
use App\Entities\History\History;
use App\Entities\Invitation\Invitation;
use App\Enums\HistoryAction;
use App\Enums\HistoryActionableTypes;
use App\Enums\HistoryUsableTypes;
use App\Exceptions\Invitation\CannotDeleteInvitationException;
use Crm\Locators\CurrentAdminLocator;
use Crm\Repositories\Admin\AdminRepository;
use Crm\Repositories\Admin\HistoryRepository;
use Crm\Repositories\Company\CompanyRepository;
use Crm\Repositories\Employee\EmployeeRepository;
use Crm\Repositories\Invitation\InvitationRepository;
use Crm\Services\BaseService;
use Crm\Services\Invitation\Events\InvitationWasCreated;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;

class InvitationService extends BaseService
{
    public function __construct(
        readonly private InvitationRepository $invitationRepository,
        readonly private CompanyRepository $companyRepository,
        readonly private AdminRepository $adminRepository,
        readonly private EmployeeRepository $employeeRepository,
        readonly private EventDispatcher $eventDispatcher,
        readonly private HistoryRepository $historyRepository,
        readonly private CurrentAdminLocator $currentAdminLocator
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
        $invitation = $this->invitationRepository->findById($id);
        if (!$invitation instanceof Invitation) {
            return null;
        }

        return $this->hydrate($invitation);
    }

    public function findByToken(string $token): ?Invitation
    {
        return $this->invitationRepository->findByToken($token);
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

        $admin = $this->currentAdminLocator->getAdmin();
        $this->historyRepository->create(
            [
                History::USEABLE_ID_COLUMN      => $admin->getId(),
                History::USEABLE_TYPE_COLUMN    => HistoryUsableTypes::ADMIN,
                History::USEABLE_NAME_COLUMN    => $admin->getName(),
                History::ACTION_COLUMN          => HistoryAction::CANCELED,
                History::ACTIONABLE_ID_COLUMN   => $invitation->getId(),
                History::ACTIONABLE_NAME_COLUMN => $invitation->getName(),
                History::ACTIONABLE_TYPE_COLUMN => HistoryActionableTypes::INVITATION,
            ]
        );

        return $this->invitationRepository->delete($invitation->getId());
    }

    /**
     * @param array $attributes
     *
     * @return Invitation
     * @throws CannotDeleteInvitationException
     */
    public function create(array $attributes): Invitation
    {
        $invitation = $this->invitationRepository->findByEmail(Arr::get($attributes, Invitation::EMAIL_COLUMN));
        if ($invitation instanceof Invitation) {
            throw new CannotDeleteInvitationException($invitation, 'invitation is already created using this email');
        }

        $invitation = $this->invitationRepository->create($attributes);
        $this->eventDispatcher->dispatch(new InvitationWasCreated($invitation->getId()));

        $admin = $this->currentAdminLocator->getAdmin();
        $this->historyRepository->create(
            [
                History::USEABLE_ID_COLUMN      => $admin->getId(),
                History::USEABLE_TYPE_COLUMN    => HistoryUsableTypes::ADMIN,
                History::USEABLE_NAME_COLUMN    => $admin->getName(),
                History::ACTION_COLUMN          => HistoryAction::INVITES,
                History::ACTIONABLE_ID_COLUMN   => $invitation->getCompanyId(),
                History::ACTIONABLE_NAME_COLUMN => $invitation->getName(),
                History::ACTIONABLE_TYPE_COLUMN => HistoryActionableTypes::EMPLOYEE,
            ]
        );

        return $invitation;
    }
}

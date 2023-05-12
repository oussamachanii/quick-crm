<?php

namespace Crm\Services\Company;

use App\Entities\Company\Company;
use App\Exceptions\Company\CannotDeleteCompanyException;
use Crm\Repositories\Company\CompanyRepository;
use Crm\Repositories\Employee\EmployeeRepository;
use Crm\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyService extends BaseService
{
    public function __construct(
        readonly private CompanyRepository $companyRepository,
        readonly private EmployeeRepository $employeeRepository
    ) {
    }

    public function getPaginated(string $search = null): LengthAwarePaginator
    {
        return $this->companyRepository->getPaginated($search);
    }

    public function findById(string $id): ?Company
    {
        return $this->companyRepository->findById($id);
    }

    /**
     * @param Company $company
     *
     * @return bool
     * @throws CannotDeleteCompanyException
     */
    public function delete(Company $company): bool
    {
        $employees = $this->employeeRepository->getByCompanyId($company->getId());
        if (! $employees->isEmpty()) {
            throw new CannotDeleteCompanyException($company, 'company have associated employees');
        }

        return $this->companyRepository->delete($company->getId());
    }

    public function update(Company $company, array $attributes): bool
    {
        return $this->companyRepository->update($company->getId(), $attributes);
    }

    public function create(array $attributes): Company
    {
        return $this->companyRepository->create($attributes);
    }
}

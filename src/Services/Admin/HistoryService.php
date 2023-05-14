<?php

namespace Crm\Services\Admin;

use App\Entities\History\History;
use App\Enums\HistoryAction;
use Crm\Repositories\Admin\HistoryRepository;
use Crm\Repositories\Company\CompanyRepository;
use Crm\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class HistoryService extends BaseService
{
    public function __construct(
        private readonly HistoryRepository $historyRepository,
        private readonly CompanyRepository $companyRepository,
    ) {
    }

    public function getPaginated(): LengthAwarePaginator
    {
        $paginated = $this->historyRepository->getPaginated();
        $histories = $paginated->getCollection();
        $histories = $histories->map(fn (History $history) => $this->hydrate($history));
        return $paginated->setCollection($histories);
    }

    private function hydrate(History $history): History
    {
        return $history->setMessage($this->composeLogMessage($history));
    }

    private function composeLogMessage(History $history): string
    {
        $companyName = $this->companyRepository->findById($history->getActionableId())?->getName();

        $messages = [
            HistoryAction::INVITES->value   => "Admin ':adminName' is invited the employee ':employeeName' to join ':companyName' company",
            HistoryAction::CANCELED->value  => "Admin ':adminName' has canceled ':employeeName' invitation to join ':companyName' company",
            HistoryAction::CONFIRMED->value => "':employeeName' has confirmed his profile",
            HistoryAction::VALIDATES->value => "':adminName' has validated ':employeeName' profile",
        ];

        $message = $messages[$history->getAction()->value] ?? null;
        if ($message === null) {
            return 'unknown history';
        }

        return strtr($message, [
            ':adminName'    => $history->getUseableName(),
            ':employeeName' => $history->getActionableName(),
            ':companyName'  => $companyName ?? 'unknown',
        ]);
    }

    public function create(array $attributes): History
    {
        return $this->historyRepository->create($attributes);
    }

    public function log(array $attributes): History
    {
        // This log action better to be queueable to not affect application performance
        return $this->create($attributes);
    }
}

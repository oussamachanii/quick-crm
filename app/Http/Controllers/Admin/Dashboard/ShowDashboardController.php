<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\BaseAdminController;
use Crm\Services\Admin\HistoryService;
use Throwable;

class ShowDashboardController extends BaseAdminController
{
    public function __construct(
        private readonly HistoryService $historyService
    ) {
        parent::__construct();
    }

    public function __invoke()
    {
        try {
            $histories = $this->historyService->getPaginated();

            return $this->view('admin.pages.dashboard', [
                'histories' => $histories,
            ]);
        } catch (Throwable $e) {
            // Log the error here
            return redirect()
                ->back()
                ->withErrors('an error has been occurred');
        }
    }
}

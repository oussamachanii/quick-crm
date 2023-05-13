<?php

namespace App\Http\Controllers\Employee;

use App\Entities\Employee\Employee;
use App\Exceptions\Employee\Auth\EmployeeNotLoggedInException;
use Crm\Managers\Auth\Employee\EmployeeAuthManager;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BaseEmployeeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected readonly EmployeeAuthManager $employeeAuthManager;

    public function __construct()
    {
        $this->employeeAuthManager = app(EmployeeAuthManager::class);
    }

    public function view(string $view, array $data = [])
    {
        // Base information can be added here. Locale, Country, .....
        return view(
            $view,
            array_merge(
                $data,
                [
                    'employee' => $this->getCurrentEmployee(),
                ]
            )
        );
    }

    /**
     * @return Employee
     * @throws EmployeeNotLoggedInException
     */
    public function getCurrentEmployee(): Employee
    {
        $employee = $this->employeeAuthManager->user();

        if (!$employee instanceof Employee) {
            throw new EmployeeNotLoggedInException();
        }

        return $employee;
    }
}

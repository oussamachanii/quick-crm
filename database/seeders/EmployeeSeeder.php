<?php

namespace Database\Seeders;

use App\Entities\Employee\Employee;
use App\Enums\EmployeeStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends BaseSeeder
{
    public function __construct(
        private readonly CompanySeeder $companySeeder
    ) {
        parent::__construct();
    }

    public function createOne(): Employee
    {
        return Employee::query()
            ->create(
                [
                    Employee::NAME_COLUMN       => $this->faker->name(),
                    Employee::EMAIL_COLUMN      => $this->faker->email(),
                    Employee::ADDRESS_COLUMN    => $this->faker->streetAddress(),
                    Employee::PHONE_COLUMN      => $this->faker->e164PhoneNumber(),
                    Employee::COMPANY_ID_COLUMN => $this->companySeeder->createOne()->getId(),
                    Employee::STATUS_COLUMN     => EmployeeStatus::ACTIVE,
                    Employee::PASSWORD_COLUMN   => Hash::make(self::PASSWORD),
                    Employee::BIRTHDATE_COLUMN  => $this->faker->date(),
                ]
            );
    }
}

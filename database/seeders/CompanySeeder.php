<?php

namespace Database\Seeders;

use App\Entities\Company\Company;

class CompanySeeder extends BaseSeeder
{
    public function createOne(): Company
    {
        return Company::query()
            ->create(
                [
                    Company::NAME_COLUMN    => $this->faker->company(),
                    Company::ADDRESS_COLUMN => $this->faker->address(),
                    Company::CAPITAL_COLUMN => $this->faker->randomNumber(8),
                ]
            );
    }
}

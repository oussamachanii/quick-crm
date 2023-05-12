<?php

namespace Database\Seeders;

use App\Entities\Admin\Admin;
use App\Entities\Invitation\Invitation;

class InvitationSeeder extends BaseSeeder
{
    public function __construct(
        readonly private CompanySeeder $companySeeder
    ) {
        parent::__construct();
    }

    public function createOne(): Invitation
    {
        return Invitation::query()
            ->create(
                [
                    Invitation::EMAIL_COLUMN      => $this->faker->email(),
                    Invitation::TOKEN_COLUMN      => $this->faker->uuid(),
                    Invitation::NAME_COLUMN       => $this->faker->name(),
                    Invitation::ADMIN_ID_COLUMN   => Admin::query()->first()->getId(),
                    Invitation::COMPANY_ID_COLUMN => $this->companySeeder->createOne()->getId(),
                ]
            );
    }
}

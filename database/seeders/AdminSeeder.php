<?php

namespace Database\Seeders;

use App\Entities\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->createOne();
    }

    public function createOne(): Admin
    {
        return Admin::query()
            ->create(
                [
                    Admin::NAME_COLUMN     => 'Oussama Chanii',
                    Admin::EMAIL_COLUMN    => 'chaniioussama1@gmail.com',
                    Admin::PASSWORD_COLUMN => Hash::make(self::PASSWORD),
                ]
            );
    }
}

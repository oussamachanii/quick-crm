<?php

namespace Database\Seeders;

use App\Entities\Model;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

abstract class BaseSeeder extends Seeder
{
    protected Faker $faker;
    protected const COUNT = 100;
    protected const PASSWORD = 'password';

    public function __construct()
    {
        $this->faker = app(Faker::class);
    }

    public function run(): void
    {
        for ($i = 0; $i < self::COUNT; $i++) {
            $this->createOne();
        }
    }

    abstract public function createOne(): Model;
}

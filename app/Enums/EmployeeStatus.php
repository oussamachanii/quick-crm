<?php

namespace App\Enums;

enum EmployeeStatus: int
{
    case CONFIRMED = 1;
    case UNCONFIRMED = 0;
}

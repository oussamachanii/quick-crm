<?php

namespace App\Enums;

enum HistoryActionableTypes: int
{
    case ADMIN = 1;
    case EMPLOYEE = 2;
    case INVITATION = 3;
}

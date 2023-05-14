<?php

namespace App\Enums;

enum HistoryAction: int
{
    case VALIDATES = 1;
    case INVITES = 2;
    case CONFIRMED = 3;
    case CREATED = 4;
    case DELETED = 5;
    case EDITED = 6;
    case CANCELED = 7;
}

<?php

namespace App\Enum;

enum ContactStatus: int
{
    case CURRENT = 1;
    case DEAL = 2;
    case ARCHIVED = 3;
    case LOST = 4;
}

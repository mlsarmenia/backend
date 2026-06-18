<?php

namespace App\Enum;

enum ContactType: int
{
    case SELLER = 1;
    case RENT_OWNER = 2;
    case BROKER = 3;
    case BUYER = 4;
    case RENTER = 5;
    case USER = 6;
}

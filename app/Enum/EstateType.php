<?php

namespace App\Enum;

enum EstateType: int
{
    case APARTMENT = 1;
    case HOUSE = 2;
    case COMMERCIAL = 3;
    case LAND = 4;
    case TOWNHOUSE = 5;
}

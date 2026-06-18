<?php

namespace App\Enum;

use App\Enum\Contract\HasName;
use App\Enum\Trait\GetsNames;

enum RoomsQuantity: int implements HasName
{
    use GetsNames;

    case ONE = 1;
    case TWO = 2;
    case THREE = 3;
    case FOUR = 4;
    case FOUR_PLUS = 5;

    public function name(): string
    {
        return match ($this) {
            self::ONE => '1',
            self::TWO => '2',
            self::THREE => '3',
            self::FOUR => '4',
            self::FOUR_PLUS => '4+',
        };
    }
}

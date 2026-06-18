<?php

namespace App\Enum\B24;

use App\Enum\Trait\GetsCaseFromTitle;

enum Room: int
{
    use GetsCaseFromTitle;

    case UNDEFINED = 1103;
    case ONE = 1105;
    case TWO = 1107;
    case THREE = 1109;
    case FOUR = 1111;
    case FIVE = 1113;
    case FIVE_PLUS = 3207;

    public function title(): ?string
    {
        return match ($this) {
            self::ONE => '1',
            self::TWO => '2',
            self::THREE => '3',
            self::FOUR => '4',
            self::FIVE => '5',
            self::FIVE_PLUS => '5+',
            default => null,
        };
    }
}

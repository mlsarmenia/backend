<?php

namespace App\Enum\B24\Lead;

enum Area: int
{
    case UNDEFINED = 1001;
    case UP_TO_40 = 1003;
    case FROM_40_TO_60 = 1005;
    case FROM_60_TO_80 = 1007;
    case FROM_80_TO_100 = 1009;
    case FROM_100_TO_125 = 1011;
    case FROM_125_TO_150 = 1013;
    case MORE_THAN_150 = 1015;

    public function fromArea(): ?int
    {
        return match ($this) {
            self::UNDEFINED, self::UP_TO_40 => null,
            self::FROM_40_TO_60 => 40,
            self::FROM_60_TO_80 => 60,
            self::FROM_80_TO_100 => 80,
            self::FROM_100_TO_125 => 100,
            self::FROM_125_TO_150 => 125,
            self::MORE_THAN_150 => 150,
        };
    }

    public function toArea(): ?int
    {
        return match ($this) {
            self::UP_TO_40 => 40,
            self::FROM_40_TO_60 => 60,
            self::FROM_60_TO_80 => 80,
            self::FROM_80_TO_100 => 100,
            self::FROM_100_TO_125 => 125,
            self::FROM_125_TO_150 => 150,
            self::MORE_THAN_150, self::UNDEFINED => null,
        };
    }
}

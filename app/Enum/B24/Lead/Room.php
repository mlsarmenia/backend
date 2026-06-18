<?php

namespace App\Enum\B24\Lead;

enum Room: int
{
    case UNDEFINED = 1045;
    case ONE = 1017;
    case TWO = 1019;
    case THREE = 1021;
    case FOUR = 1023;
    case FIVE = 1025;
    case FIVE_PLUS = 3209;

    public function fromNumber(): ?int
    {
        return match ($this) {
            self::UNDEFINED => null,
            self::ONE => 1,
            self::TWO => 2,
            self::THREE => 3,
            self::FOUR => 4,
            self::FIVE, self::FIVE_PLUS => 5,
        };
    }

    public function toNumber(): ?int
    {
        return match ($this) {
            self::UNDEFINED, self::FIVE_PLUS => null,
            self::ONE => 1,
            self::TWO => 2,
            self::THREE => 3,
            self::FOUR => 4,
            self::FIVE => 5,
        };
    }
}

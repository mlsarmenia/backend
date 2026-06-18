<?php

namespace App\Enum;

enum EstateRentPriceAmd: int
{
    case UP_TO_50 = 1;
    case FROM_50_TO_75 = 2;
    case FROM_75_TO_100 = 3;
    case TO_100_TO_125 = 4;
    case TO_125_TO_150 = 5;
    case TO_150_TO_200 = 6;
    case TO_200_TO_300 = 7;
    case TO_300_TO_400 = 8;
    case MORE_THAN_400 = 9;

    private function fromPrice(): ?int
    {
        return match ($this) {
            self::UP_TO_50 => null,
            self::FROM_50_TO_75 => 50000,
            self::FROM_75_TO_100 => 75000,
            self::TO_100_TO_125 => 100000,
            self::TO_125_TO_150 => 125000,
            self::TO_150_TO_200 => 150000,
            self::TO_200_TO_300 => 200000,
            self::TO_300_TO_400 => 300000,
            self::MORE_THAN_400 => 400000,
        };
    }

    private function toPrice(): ?int
    {
        return match ($this) {
            self::UP_TO_50 => 50000,
            self::FROM_50_TO_75 => 75000,
            self::FROM_75_TO_100 => 100000,
            self::TO_100_TO_125 => 125000,
            self::TO_125_TO_150 => 150000,
            self::TO_150_TO_200 => 200000,
            self::TO_200_TO_300 => 300000,
            self::TO_300_TO_400 => 400000,
            self::MORE_THAN_400 => null,
        };
    }

    private function label(): ?string
    {
        return match ($this) {
            self::UP_TO_50 => __('price.rent.up_to_50'),
            self::FROM_50_TO_75 => __('price.rent.from_50_to_75'),
            self::FROM_75_TO_100 => __('price.rent.from_75_to_100'),
            self::TO_100_TO_125 => __('price.rent.from_100_to_125'),
            self::TO_125_TO_150 => __('price.rent.from_125_to_150'),
            self::TO_150_TO_200 => __('price.rent.from_150_to_200'),
            self::TO_200_TO_300 => __('price.rent.from_200_to_300'),
            self::TO_300_TO_400 => __('price.rent.from_300_to_400'),
            self::MORE_THAN_400 => __('price.rent.more_than_400'),
        };
    }

    public static function all(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
            'from' => $case->fromPrice(),
            'to' => $case->toPrice(),
        ], self::cases());
    }
}

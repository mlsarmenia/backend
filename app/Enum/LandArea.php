<?php

namespace App\Enum;

enum LandArea: int
{
    case UP_TO_100 = 1;
    case FROM_100_TO_200 = 2;
    case FROM_200_TO_500 = 3;
    case FROM_500_TO_1000 = 4;
    case FROM_1000_TO_2000 = 5;
    case FROM_2000_TO_5000 = 6;
    case FROM_5000_TO_10000 = 7;
    case MORE_THAN_10000 = 8;

    private function fromArea(): ?int
    {
        return match ($this) {
            self::UP_TO_100 => null,
            self::FROM_100_TO_200 => 100,
            self::FROM_200_TO_500 => 200,
            self::FROM_500_TO_1000 => 500,
            self::FROM_1000_TO_2000 => 1000,
            self::FROM_2000_TO_5000 => 2000,
            self::FROM_5000_TO_10000 => 5000,
            self::MORE_THAN_10000 => 10000,
        };
    }

    private function toArea(): ?int
    {
        return match ($this) {
            self::UP_TO_100 => 100,
            self::FROM_100_TO_200 => 200,
            self::FROM_200_TO_500 => 500,
            self::FROM_500_TO_1000 => 1000,
            self::FROM_1000_TO_2000 => 2000,
            self::FROM_2000_TO_5000 => 5000,
            self::FROM_5000_TO_10000 => 10000,
            self::MORE_THAN_10000 => null,
        };
    }

    private function label(): ?string
    {
        return match ($this) {
            self::UP_TO_100 => __('area.up_to_100'),
            self::FROM_100_TO_200 => __('area.from_100_to_200'),
            self::FROM_200_TO_500 => __('area.from_200_to_500'),
            self::FROM_500_TO_1000 => __('area.from_500_to_1000'),
            self::FROM_1000_TO_2000 => __('area.from_1000_to_2000'),
            self::FROM_2000_TO_5000 => __('area.from_2000_to_5000'),
            self::FROM_5000_TO_10000 => __('area.from_5000_to_10000'),
            self::MORE_THAN_10000 => __('area.more_than_10000'),
        };
    }

    public static function all(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
            'from' => $case->fromArea(),
            'to' => $case->toArea(),
        ], self::cases());
    }
}

<?php

namespace App\Enum;

enum BuildingArea: int
{
    case UP_TO_40 = 1;
    case FROM_40_TO_60 = 2;
    case FROM_60_TO_80 = 3;
    case FROM_80_TO_100 = 4;
    case FROM_100_TO_125 = 5;
    case FROM_125_TO_150 = 6;
    case MORE_THAN_150 = 7;

    private function fromArea(): ?int
    {
        return match ($this) {
            self::UP_TO_40 => null,
            self::FROM_40_TO_60 => 40,
            self::FROM_60_TO_80 => 60,
            self::FROM_80_TO_100 => 80,
            self::FROM_100_TO_125 => 100,
            self::FROM_125_TO_150 => 125,
            self::MORE_THAN_150 => 150,
        };
    }

    private function toArea(): ?int
    {
        return match ($this) {
            self::UP_TO_40 => 40,
            self::FROM_40_TO_60 => 60,
            self::FROM_60_TO_80 => 80,
            self::FROM_80_TO_100 => 100,
            self::FROM_100_TO_125 => 125,
            self::FROM_125_TO_150 => 150,
            self::MORE_THAN_150 => null,
        };
    }

    private function label(): ?string
    {
        return match ($this) {
            self::UP_TO_40 => __('area.up_to_40'),
            self::FROM_40_TO_60 => __('area.from_40_to_60'),
            self::FROM_60_TO_80 => __('area.from_60_to_80'),
            self::FROM_80_TO_100 => __('area.from_80_to_100'),
            self::FROM_100_TO_125 => __('area.from_100_to_125'),
            self::FROM_125_TO_150 => __('area.from_125_to_150'),
            self::MORE_THAN_150 => __('area.more_than_150'),
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

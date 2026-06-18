<?php

namespace App\Enum;

enum EstateSalePriceAmd: int
{
    case UP_TO_15 = 1;
    case FROM_15_TO_20 = 2;
    case FROM_20_TO_30 = 3;
    case FROM_30_TO_40 = 4;
    case FROM_40_TO_50 = 5;
    case FROM_50_TO_60 = 6;
    case FROM_60_TO_75 = 7;
    case FROM_75_TO_90 = 8;
    case FROM_90_TO_100 = 9;
    case MORE_THAN_100 = 10;

    private function fromPrice(): ?int
    {
        return match ($this) {
            self::UP_TO_15 => null,
            self::FROM_15_TO_20 => 15000000,
            self::FROM_20_TO_30 => 20000000,
            self::FROM_30_TO_40 => 30000000,
            self::FROM_40_TO_50 => 40000000,
            self::FROM_50_TO_60 => 50000000,
            self::FROM_60_TO_75 => 60000000,
            self::FROM_75_TO_90 => 75000000,
            self::FROM_90_TO_100 => 90000000,
            self::MORE_THAN_100 => 100000000,
        };
    }

    private function toPrice(): ?int
    {
        return match ($this) {
            self::UP_TO_15 => 15000000,
            self::FROM_15_TO_20 => 20000000,
            self::FROM_20_TO_30 => 30000000,
            self::FROM_30_TO_40 => 40000000,
            self::FROM_40_TO_50 => 50000000,
            self::FROM_50_TO_60 => 60000000,
            self::FROM_60_TO_75 => 75000000,
            self::FROM_75_TO_90 => 90000000,
            self::FROM_90_TO_100 => 100000000,
            self::MORE_THAN_100 => null,
        };
    }

    private function label(): string
    {
        return match ($this) {
            self::UP_TO_15 => __('price.sale.up_to_15'),
            self::FROM_15_TO_20 => __('price.sale.from_15_to_20'),
            self::FROM_20_TO_30 => __('price.sale.from_20_to_30'),
            self::FROM_30_TO_40 => __('price.sale.from_30_to_40'),
            self::FROM_40_TO_50 => __('price.sale.from_40_to_50'),
            self::FROM_50_TO_60 => __('price.sale.from_50_to_60'),
            self::FROM_60_TO_75 => __('price.sale.from_60_to_75'),
            self::FROM_75_TO_90 => __('price.sale.from_75_to_90'),
            self::FROM_90_TO_100 => __('price.sale.from_90_to_100'),
            self::MORE_THAN_100 => __('price.sale.more_than_100'),
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

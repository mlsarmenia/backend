<?php

namespace App\Enum;

enum ContractType: int
{
    case SALE = 1;
    case RENT = 2;
    case DAILY_RENT = 3;

    public function name(): string
    {
        return match ($this) {
            self::SALE => 'Sale',
            self::RENT => 'Rent',
            self::DAILY_RENT => 'Daily Rent',
        };
    }
}

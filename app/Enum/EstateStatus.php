<?php

namespace App\Enum;

use App\Enum\Contract\HasName;
use App\Enum\Trait\GetsNames;

enum EstateStatus: int implements HasName
{
    use GetsNames;

    case DRAFT = 1;
    case INCOMPLETE = 2;
    case WAITING_FOR_CONFIRMATION = 3;
    case CONFIRMED = 4;
    case RENTED = 6;
    case SOLD = 7;
    case ARCHIVED = 8;
    case NEW_REQUEST = 9;

    public function name(): string
    {
        return match ($this) {
            self::DRAFT => 'Սևագիր',
            self::INCOMPLETE => 'Թերի Լրացված',
            self::WAITING_FOR_CONFIRMATION => 'Տեղազնված',
            self::CONFIRMED => 'Հաստատված',
            self::RENTED => 'Վարձակալված',
            self::SOLD => 'Վաճառված',
            self::ARCHIVED => 'Արխիվացված',
            self::NEW_REQUEST => 'Նոր Հայտ',
        };
    }
}

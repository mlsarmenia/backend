<?php

namespace App\Enum;

use App\Enum\Contract\HasName;
use App\Enum\Trait\GetsNames;

enum BuildingType: int implements HasName
{
    use GetsNames;

    case STONE = 1;
    case PANEL = 2;
    case MONOLITH = 3;
    case CONCRETE_BLOCK = 4;

    public function name(): string
    {
        return match ($this) {
            self::STONE => 'քարե',
            self::PANEL => 'պանելային',
            self::MONOLITH => 'մոնոլիտ',
            self::CONCRETE_BLOCK => 'բետոնե բլոկ',
        };
    }
}

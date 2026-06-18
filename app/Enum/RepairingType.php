<?php

namespace App\Enum;

use App\Enum\Contract\HasName;
use App\Enum\Trait\GetsNames;

enum RepairingType: int implements HasName
{
    use GetsNames;

    case DEPLORABLE = 1;
    case BAD = 2;
    case SATISFYING = 3;
    case MIDDLE = 4;
    case WELL_MAINTAINED = 5;
    case GOOD = 6;
    case EXCELLENT = 7;

    public function name(): string
    {
        return match ($this) {
            self::DEPLORABLE => 'անբավարար',
            self::BAD => 'վատ',
            self::SATISFYING => 'բավարար',
            self::MIDDLE => 'միջին',
            self::WELL_MAINTAINED => 'բարվոք',
            self::GOOD => 'լավ / կապիտալ /',
            self::EXCELLENT => 'գերազանց /կապիտալ/',
        };
    }
}

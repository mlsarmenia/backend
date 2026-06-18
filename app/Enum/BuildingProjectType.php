<?php

namespace App\Enum;

use App\Enum\Contract\HasName;
use App\Enum\Trait\GetsNames;

enum BuildingProjectType: int implements HasName
{
    use GetsNames;

    case STALIN_CONCRETE_COVER = 1;
    case SPECIAL = 2;
    case CZECH = 3;
    case KHRUSHCHEV = 4;
    case STALIN_WOODEN_COVER = 5;
    case BADALYAN = 6;
    case GEORGIAN = 7;
    case YEREVAN_DSK = 8;
    case MOSCOW_DSK = 9;
    case POST_KHRUSHCHEV = 10;
    case CASSETTE = 11;
    case LARGE_PANEL = 12;
    case NEW_BUILT_MONOLITH = 13;
    case DORMITORY = 14;
    case SIXTEEN_STOREY = 15;
    case TYPICAL_PANEL = 16;
    case ENTRANCE_WITHOUT_WINDOWS = 17;
    case NOT_TYPICAL = 18;
    case FINNISH = 21;
    case YUGOSLAV = 22;

    public function name(): string
    {
        return match ($this) {
            self::STALIN_CONCRETE_COVER => 'Ստալինյան /բետոնե ծածկով/',
            self::SPECIAL => 'հատուկ',
            self::CZECH => 'Չեխական',
            self::KHRUSHCHEV => 'Խրուշչովյան',
            self::STALIN_WOODEN_COVER => 'Ստալինյան /փայտյա ծածկերով/',
            self::BADALYAN => 'Բադալյան',
            self::GEORGIAN => 'Վրացական',
            self::YEREVAN_DSK => 'Մոսկովյան ԴՍԿ',
            self::MOSCOW_DSK => 'Moscow DSK',
            self::POST_KHRUSHCHEV => 'Հետխռյուշչովյան',
            self::CASSETTE => 'կասետային',
            self::LARGE_PANEL => 'Խոշորպանելային',
            self::NEW_BUILT_MONOLITH => 'Նորակառույց',
            self::DORMITORY => 'հանրակացարան',
            self::SIXTEEN_STOREY => '16 հարկանի',
            self::TYPICAL_PANEL => 'Պանելային տիպային',
            self::ENTRANCE_WITHOUT_WINDOWS => 'մուտքը առանց լուսամուտների',
            self::NOT_TYPICAL => 'ոչ տիպային',
            self::FINNISH => 'բարձրահարկ Չեխական',
            self::YUGOSLAV => 'Յուգոսլավյան',
        };
    }
}

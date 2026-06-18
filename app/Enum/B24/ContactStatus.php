<?php

namespace App\Enum\B24;

enum ContactStatus: string
{
    case NEW = 'NEW';
    case CURRENT = 'UC_SLGXHD';
    case PLANNED_MEETINGS = 'UC_4GAMN7';
    case MET = 'UC_FET8DA';
    case WORK = 'UC_Y98ZPA';
    case UNRESERVED = 'UC_6USDZU';
    case FROZEN = 'UC_AT9XLL';
    case INVOLVED_BY_ANOTHER_CONTACT = 'UC_4UOBD8';
    case PROCESSING = 'UC_KLPN05';
    case CONVERTED = 'CONVERTED';
    case JUNK = 'JUNK';
    case FAILED = '4';

    public function title(): string
    {
        return match ($this) {
            self::NEW => 'ՉՀԱՄԱԿԱՐԳԱԾ ՀԱՐՑՈՒՄ',
            self::CURRENT => 'ԸՆԹԱՑԻԿ I ԼԻԴԻ ՄՇԱԿՈՒՄ',
            self::PLANNED_MEETINGS => 'ՊԼԱՆԱՎՈՐՎԱԾ ՀԱՆԴԻՊՈՒՄՆԵՐ',
            self::MET => 'ՀԱՆԴԻՊԱԾ',
            self::WORK => 'ԱՇԽԱՏԱՆՔ',
            self::UNRESERVED => 'ՀԱՆԴԻՊԱԾ I ՉԱՄՐԱԳՐԱԾ',
            self::FROZEN => 'ՍԱՌԵՑՎԱԾ',
            self::INVOLVED_BY_ANOTHER_CONTACT => 'ԱՅԼ ԿՈՆՏԱԿՏՈՎ ՆԵՐԳՐԱՎՎԱԾ',
            self::PROCESSING => 'ՎԵՐԱՄՇԱԿՄԱՆ ԵՆԹԱԿԱ',
            self::CONVERTED => 'ԱՄՐԱԳՐՎԱԾ',
            self::JUNK => 'ՀԱՐՑՈՒՄ',
            self::FAILED => 'ՊԱՐՏՎԱԾ',
        };
    }
}

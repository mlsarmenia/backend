<?php

namespace App\Enum\B24;

enum Estate: string
{
    case BUILDING = 'UF_CRM_1638450408286';
    case ENTRANCE = 'UF_CRM_1638450419642';
    case FLOOR = 'UF_CRM_1638450436213';
    case APARTMENT_NUMBER = 'UF_CRM_1638450463867';
    case PRICE = 'UF_CRM_1638450584267';
    case CODE = 'UF_CRM_61B882C677226';
    case ROOM = 'UF_CRM_61E5686922733';
    case PROJECT = 'UF_CRM_61EAA18DD30E4';
    case AREA = 'UF_CRM_1661414502';
    case STAGE = 'STAGE_ID';
    case ID = 'ID';
    case ID_CODE = 'UF_CRM_1743966207757';
    case TYPE = 'UF_CRM_61B89BC2E0949';

    public function title(): ?string
    {
        return match ($this) {
            self::BUILDING => 'Մասնաշենք',
            self::ENTRANCE => 'Մուտք',
            self::FLOOR => 'Հարկ*',
            self::APARTMENT_NUMBER => 'Բնակարանի նախագծային համար',
            self::PRICE => 'Վաճառքի գին',
            self::CODE => 'Գույքի կոդ*',
            self::ROOM => 'Սենյակ*',
            self::PROJECT => 'Ամրագրված նախագիծ',
            self::AREA => 'Ք/Մ',
            self::STAGE => 'Стадия сделки',
            self::ID => 'ID',
            self::ID_CODE => 'Նույնականացման կոդ',
            default => null,
        };
    }
}

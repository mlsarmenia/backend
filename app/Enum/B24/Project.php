<?php

namespace App\Enum\B24;

use App\Enum\Trait\GetsCaseFromTitle;

enum Project: int
{
    use GetsCaseFromTitle;

    case DURYAN_HOUSE_4 = 1243;
    case ALTURA = 7035;
    case ARSHAKUNYATS = 4425;
    case STREET_21 = 1815;
    case KIEVYAN_RESIDENCE = 2141;
    case AREV = 1237;
    case THE_VIEW = 4039;
    case SHUSHI_PALACE = 1659;
    case LEVEL_16 = 1241;
    case BRIDGE_VIEW = 1245;
    case SMART_CITY_1 = 1253;
    case SMART_CITY_2 = 1657;
    case SMART_CITY_3 = 5797;
    case GARDENA = 4059;
    case SLAVONIC_RESIDENCE = 4519;
    case SUNLAND_BAGREVAND = 2111;
    case LANJIN = 2185;
    case MITOPIA = 4115;
    case UP_INN = 2143;
    case UNIT_23 = 3333;
    case CULT = 3811;
    case SAPPHIRE = 4057;
    case GARUNAVAN_4 = 4003;
    case AVAN_RESIDENCE = 4523;
    case ENCHANTE = 4521;
    case FOR_DREAM_RESIDENCE = 4689;
    case EREBUNI = 5793;
    case LUMINA_RESIDENCE = 5053;
    case THE_HILL_RESIDENCE = 5727;
    case EIGHT_RESIDENCE = 6683;
    case IN_TOWN = 8271;
    case ARGISHTI_SUITS_AND_RESIDENCE = 6071;
    case DREAM_STONE_RESIDENCE = 5795;
    case WEST_TOWN = 1255;
    case FOR_REST = 6055;
    case DILI_TROPIC = 6691;
    case DALAN_TECHNOPARK = 2145;
    case DALAN_TECH_PARKING = 6095;
    case DAVTASHEN_TOWN = 4163;
    case DAVTASHEN_TOWN_2 = 6787;
    case DURYAN_HOUSE_1 = 4395;
    case DURYAN_HOUSE_2 = 4397;
    case WHITE_CITY = 1721;
    case VAHAKNI_TOWNHOUSE = 1723;
    case ART_HOUSE = 1257;
    case GRIBOYEDOV_PARK = 2187;
    case GARUNAVAN_3 = 1261;
    case EREBUNI_DAVIT_BEK = 1263;
    case ATLAS = 1247;
    case ULNETSI = 4439;
    case MOLDOVAKAN = 1249;
    case BABAJANYAN = 1259;
    case TESARAN = 4001;
    case DURYAN_5 = 10101;
    case NOVOTEL_LIVING = 10103;
    case OLYMPUS_DAVTASHEN = 10441;
    case SIL = 10615;

    public function title(): string
    {
        return match ($this) {
            self::DURYAN_HOUSE_4 => 'Դուրյան Հաուս 4',
            self::ALTURA => 'Ալտուրա',
            self::ARSHAKUNYATS => 'Արշակունյաց',
            self::STREET_21 => '21 Սթրիթ',
            self::KIEVYAN_RESIDENCE => 'Կիևյան Ռեզիդենս',
            self::AREV => 'ԱՐԵՎ',
            self::THE_VIEW => 'Դը Վյու',
            self::SHUSHI_PALACE => 'Շուշի Փելըս',
            self::LEVEL_16 => 'Լեվել 16',
            self::BRIDGE_VIEW => 'Բրիջվյու',
            self::SMART_CITY_1 => 'Սմարթ Սիթի 1',
            self::SMART_CITY_2 => 'Սմարթ Սիթի 2',
            self::SMART_CITY_3 => 'Սմարթ Սիթի 3',
            self::GARDENA => 'Գարդենա',
            self::SLAVONIC_RESIDENCE => 'Սլավոնական Ռեզիդենս',
            self::SUNLAND_BAGREVAND => 'Սանլենդ Բագրեվանդ',
            self::LANJIN => 'Լանջին',
            self::MITOPIA => 'Միտոպիա',
            self::UP_INN => 'ԱփԻն',
            self::UNIT_23 => 'Յունիթ 23',
            self::CULT => 'ՔՈՒԼՏ',
            self::SAPPHIRE => 'Սապֆիր',
            self::GARUNAVAN_4 => 'Գարունավան 4',
            self::AVAN_RESIDENCE => 'Ավան Ռեզիդենս',
            self::ENCHANTE => 'Էնշանթե',
            self::FOR_DREAM_RESIDENCE => 'Ֆոր Դրիմ Ռեզիդենս',
            self::EREBUNI => 'Էրեբունի',
            self::LUMINA_RESIDENCE => 'Լումինա Ռեզիդենս',
            self::THE_HILL_RESIDENCE => 'Դը Հիլլ Ռեզիդենս',
            self::EIGHT_RESIDENCE => 'Էյթ Ռեզիդենս',
            self::IN_TOWN => 'Ին Թաուն',
            self::ARGISHTI_SUITS_AND_RESIDENCE => 'Արգիշտի Սուիտս և Ռեզիդենս',
            self::DREAM_STONE_RESIDENCE => 'Դրիմ Սթոուն Ռեզիդենս',
            self::WEST_TOWN => 'Վեսթ Թաուն',
            self::FOR_REST => 'Ֆոր Ռեստ',
            self::DILI_TROPIC => 'Դիլի Տրոպիկ',
            self::DALAN_TECHNOPARK => 'Դալան Տեխնոպարկ',
            self::DALAN_TECH_PARKING => 'DALAN Tec/Parking',
            self::DAVTASHEN_TOWN => 'Դավթաշեն Թաուն',
            self::DAVTASHEN_TOWN_2 => 'Դավթաշեն Թաուն 2',
            self::DURYAN_HOUSE_1 => 'Դուրյան Հաուս 1',
            self::DURYAN_HOUSE_2 => 'Դուրյան Հաուս 2',
            self::WHITE_CITY => 'Վայթ Սիթի',
            self::VAHAKNI_TOWNHOUSE => 'Վահագնի Թաունհաուսներ',
            self::ART_HOUSE => 'ԱրտՀաուս',
            self::GRIBOYEDOV_PARK => 'Գրիբոյեդով Պարկ',
            self::GARUNAVAN_3 => 'Գարունավան 3',
            self::EREBUNI_DAVIT_BEK => 'Էրեբունի, Դավիթ Բեկի փ․ 1/25',
            self::ATLAS => 'Ատլաս',
            self::ULNETSI => 'Ուլնեցի',
            self::MOLDOVAKAN => 'Մոլդովական',
            self::BABAJANYAN => 'Բաբաջանյան 2',
            self::TESARAN => 'Տեսարան',
            self::DURYAN_5 => 'Դուրյան Հաուս 5',
            self::NOVOTEL_LIVING => 'Novotel Living',
            self::OLYMPUS_DAVTASHEN => 'Օլիմպուս Դավթաշեն',
            self::SIL => 'SIL',
        };
    }
}

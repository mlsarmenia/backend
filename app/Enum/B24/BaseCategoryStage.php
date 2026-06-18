<?php

namespace App\Enum\B24;

use App\Enum\Trait\GetsCaseFromTitle;

enum BaseCategoryStage: string
{
    use GetsCaseFromTitle;

    case NEW = 'C3:NEW';
    case PREPAYMENT_INVOICE = 'C3:PREPAYMENT_INVOICE';
    case PREPARATION = 'C3:PREPARATION';
    case FORMULATED = 'C3:UC_I8T5D8';
    case WON = 'C3:WON';
    case LOSE = 'C3:LOSE';

    public function title()
    {
        return match ($this) {
            self::NEW => 'Ընթացիկ',
            self::PREPAYMENT_INVOICE => 'Սառեցված',
            self::PREPARATION => 'Ամրագրված',
            self::FORMULATED => 'Ձևակերպված',
            self::WON => 'Վաճառված',
            self::LOSE => 'Сделка провалена',
        };
    }
}

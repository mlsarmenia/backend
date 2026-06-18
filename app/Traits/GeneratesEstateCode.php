<?php

namespace App\Traits;

use App\Enum\ContractType;
use App\Models\Estate;

trait GeneratesEstateCode
{
    private function generateEstateCode(Estate $estate): string
    {
        $code = $estate->contract_type_id !== null
            ? ($estate->contract_type_id === ContractType::SALE->value ? 0 : 1)
            : '-';
        $code .= $estate->estate_type_id ?? '-';
        $code .= $estate->room_count ?? '-';

        return $code . '-' . $estate->id;
    }
}

<?php

namespace App\Strategy\Import;

use App\Enum\B24\BaseCategoryStage;

class StageColumnProcessor implements ColumnProcessorInterface
{
    public function make(string $value)
    {
        return BaseCategoryStage::getFromTitle($value)?->value;
    }
}

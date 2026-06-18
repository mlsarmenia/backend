<?php

namespace App\Strategy\Import;

class PriceColumnProcessor implements ColumnProcessorInterface
{
    public function make(string $value)
    {
        return preg_replace('/[^\d.]/u', '', $value);
    }
}

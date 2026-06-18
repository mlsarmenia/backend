<?php

namespace App\Strategy\Import;

class CodeColumnProcessor implements ColumnProcessorInterface
{
    public function make(string $value)
    {
        return [$value];
    }
}

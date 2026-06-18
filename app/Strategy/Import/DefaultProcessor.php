<?php

namespace App\Strategy\Import;

class DefaultProcessor implements ColumnProcessorInterface
{

    public function make(string $value): string
    {
        return $value;
    }
}

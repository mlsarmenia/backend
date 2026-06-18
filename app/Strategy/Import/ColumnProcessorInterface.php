<?php

namespace App\Strategy\Import;

interface ColumnProcessorInterface
{
    public function make(string $value);
}

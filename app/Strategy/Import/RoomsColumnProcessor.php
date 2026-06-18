<?php

namespace App\Strategy\Import;

use App\Enum\B24\Room;

class RoomsColumnProcessor implements ColumnProcessorInterface
{
    public function make(string $value)
    {
        return [Room::getFromTitle($value)?->value];
    }
}

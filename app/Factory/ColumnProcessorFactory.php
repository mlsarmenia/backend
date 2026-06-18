<?php

namespace App\Factory;

use App\Enum\B24\Estate;
use App\Strategy\Import\CodeColumnProcessor;
use App\Strategy\Import\ColumnProcessorInterface;
use App\Strategy\Import\DefaultProcessor;
use App\Strategy\Import\PriceColumnProcessor;
use App\Strategy\Import\ProjectColumnProcessor;
use App\Strategy\Import\RoomsColumnProcessor;
use App\Strategy\Import\StageColumnProcessor;

class ColumnProcessorFactory
{
    protected array $handlers = [
        Estate::ROOM->name => RoomsColumnProcessor::class,
        Estate::CODE->name => CodeColumnProcessor::class,
        Estate::PROJECT->name => ProjectColumnProcessor::class,
        Estate::PRICE->name => PriceColumnProcessor::class,
        Estate::STAGE->name => StageColumnProcessor::class,
        Estate::BUILDING->name => DefaultProcessor::class,
        Estate::ENTRANCE->name => DefaultProcessor::class,
        Estate::FLOOR->name => DefaultProcessor::class,
        Estate::APARTMENT_NUMBER->name => DefaultProcessor::class,
        Estate::AREA->name => DefaultProcessor::class,
    ];

    public function getProcessor(string $columnName): ?ColumnProcessorInterface
    {
        return isset($this->handlers[$columnName])
            ? new $this->handlers[$columnName]()
            : null;
    }
}

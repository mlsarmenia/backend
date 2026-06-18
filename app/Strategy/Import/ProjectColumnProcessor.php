<?php

namespace App\Strategy\Import;

use App\Enum\B24\Project;

class ProjectColumnProcessor implements ColumnProcessorInterface
{
    public function make(string $value)
    {
        return Project::getFromTitle($value)->value;
    }
}

<?php

namespace App\Enum\Trait;

trait GetsNames
{
    public static function names(): array
    {
        $result = [];

        foreach (self::cases() as $case) {
            $result[$case->value] = $case->name();
        }

        return $result;
    }
}

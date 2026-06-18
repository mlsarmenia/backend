<?php

namespace App\Enum\Trait;

trait GetsCaseFromTitle
{
    public static function getFromTitle(string $title): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->title() === $title) {
                return $case;
            }
        }

        return null;
    }
}

<?php

namespace App\Enum;

enum Availability: int
{
    case NOT_AVAILABLE = 0;
    case AVAILABLE = 1;

    private function label(): string
    {
        return match ($this) {
            self::NOT_AVAILABLE => __('land.not_available'),
            self::AVAILABLE => __('land.available'),
        };
    }

    public static function all(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
        ], self::cases());
    }
}

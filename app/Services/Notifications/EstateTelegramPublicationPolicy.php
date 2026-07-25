<?php

namespace App\Services\Notifications;

use App\Models\Estate;

class EstateTelegramPublicationPolicy
{
    public function isReady(Estate $estate): bool
    {
        return $this->valuesAreReady(
            (bool) $estate->is_published,
            $this->nullableInt($estate->estate_status_id)
        );
    }

    public function becameReady(Estate $estate): bool
    {
        if (! $estate->wasChanged(['is_published', 'estate_status_id'])) {
            return false;
        }

        $wasReady = $this->valuesAreReady(
            (bool) $estate->getRawOriginal('is_published'),
            $this->nullableInt($estate->getRawOriginal('estate_status_id'))
        );

        return ! $wasReady && $this->isReady($estate);
    }

    private function valuesAreReady(bool $isPublished, ?int $statusId): bool
    {
        return $isPublished || in_array(
            $statusId,
            config('notifications.channels.telegram-channel.estate_status_ids', []),
            true
        );
    }

    private function nullableInt(mixed $value): ?int
    {
        return $value === null || $value === '' ? null : (int) $value;
    }
}

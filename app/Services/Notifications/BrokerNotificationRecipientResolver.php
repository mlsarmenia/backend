<?php

namespace App\Services\Notifications;

use App\Models\RealtorUser;

class BrokerNotificationRecipientResolver
{
    /**
     * @return array{broker_id: int, name: string, email: string}|null
     */
    public function find(int $brokerId): ?array
    {
        $broker = RealtorUser::query()
            ->with(['contact', 'user'])
            ->find($brokerId);

        if ($broker === null) {
            return null;
        }

        $email = strtolower(trim((string) ($broker->contact?->email ?? $broker->user?->email)));

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return null;
        }

        return [
            'broker_id' => (int) $broker->getKey(),
            'name' => trim((string) $broker->contact?->full_name) ?: "Գործակալ #{$brokerId}",
            'email' => $email,
        ];
    }
}

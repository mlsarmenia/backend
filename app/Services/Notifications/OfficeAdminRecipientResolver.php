<?php

namespace App\Services\Notifications;

use App\Models\Client;
use App\Models\User;

class OfficeAdminRecipientResolver
{
    /**
     * @return array<int, string>
     */
    public function forBuyer(Client $buyer): array
    {
        $buyer->loadMissing('contact.createdBy');
        $organizationId = $buyer->contact?->createdBy?->organization_id;

        $query = User::query()
            ->where('is_organization_admin', true)
            ->whereNotNull('email');

        $organizationId === null
            ? $query->whereNull('organization_id')
            : $query->where('organization_id', $organizationId);

        $configuredEmails = config('notifications.buyer_matches.admin_emails', []);

        if (! is_array($configuredEmails)) {
            $configuredEmails = explode(',', (string) $configuredEmails);
        }

        return collect($configuredEmails)
            ->merge($query->pluck('email'))
            ->map(fn (mixed $email): string => strtolower(trim((string) $email)))
            ->filter(fn (string $email): bool => filter_var($email, FILTER_VALIDATE_EMAIL) !== false)
            ->unique()
            ->values()
            ->all();
    }
}

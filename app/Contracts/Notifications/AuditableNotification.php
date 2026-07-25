<?php

namespace App\Contracts\Notifications;

interface AuditableNotification
{
    /**
     * @return array{
     *     event_type?: string|null,
     *     subject_type?: string|null,
     *     subject_id?: int|string|null,
     *     payload?: array<string, mixed>
     * }
     */
    public function auditContext(): array;
}

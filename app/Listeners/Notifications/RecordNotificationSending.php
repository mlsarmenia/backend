<?php

namespace App\Listeners\Notifications;

use App\Contracts\Notifications\AuditableNotification;
use App\Services\Notifications\NotificationLogRecorder;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Notifications\Notification;

class RecordNotificationSending
{
    public function __construct(private readonly NotificationLogRecorder $recorder) {}

    public function handle(NotificationSending $event): void
    {
        if (! $event->notification instanceof Notification
            || ! $event->notification instanceof AuditableNotification) {
            return;
        }

        $this->recorder->sending($event->notifiable, $event->notification, $event->channel);
    }
}

<?php

namespace App\Listeners\Notifications;

use App\Contracts\Notifications\AuditableNotification;
use App\Services\Notifications\NotificationLogRecorder;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Notifications\Notification;

class RecordNotificationSent
{
    public function __construct(private readonly NotificationLogRecorder $recorder) {}

    public function handle(NotificationSent $event): void
    {
        if (! $event->notification instanceof Notification
            || ! $event->notification instanceof AuditableNotification) {
            return;
        }

        $this->recorder->sent($event->notifiable, $event->notification, $event->channel);
    }
}

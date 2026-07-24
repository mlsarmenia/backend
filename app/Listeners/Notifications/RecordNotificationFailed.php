<?php

namespace App\Listeners\Notifications;

use App\Contracts\Notifications\AuditableNotification;
use App\Services\Notifications\NotificationLogRecorder;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Notification;
use Throwable;

class RecordNotificationFailed
{
    public function __construct(private readonly NotificationLogRecorder $recorder) {}

    public function handle(NotificationFailed $event): void
    {
        if (! $event->notification instanceof Notification
            || ! $event->notification instanceof AuditableNotification) {
            return;
        }

        $exception = $event->data['exception'] ?? null;
        $error = $exception instanceof Throwable
            ? $exception->getMessage()
            : (string) ($event->data['message'] ?? 'Notification delivery failed.');

        $this->recorder->failed(
            $event->notifiable,
            $event->notification,
            $event->channel,
            $error
        );
    }
}

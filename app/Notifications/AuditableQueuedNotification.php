<?php

namespace App\Notifications;

use App\Contracts\Notifications\AuditableNotification;
use App\Services\Notifications\NotificationChannelRouter;
use App\Services\Notifications\NotificationLogRecorder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Notifications\Notification;
use Throwable;

abstract class AuditableQueuedNotification extends Notification implements AuditableNotification, ShouldQueueAfterCommit
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 60;

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return app(NotificationChannelRouter::class)->route(
            $notifiable,
            $this->requestedChannels(),
            $this
        );
    }

    /**
     * @return array<string, string>
     */
    public function viaQueues(): array
    {
        $queue = (string) config('notifications.queue', 'notifications');
        $queues = [];

        foreach (config('notifications.channels', []) as $settings) {
            $driver = $settings['driver'] ?? null;

            if (($settings['enabled'] ?? false) && is_string($driver) && $driver !== '') {
                $queues[$driver] = $queue;
            }
        }

        return $queues;
    }

    public function failed(Throwable $exception): void
    {
        app(NotificationLogRecorder::class)->queuedNotificationFailed($this, $exception);
    }

    /**
     * @return array<int, string>
     */
    abstract protected function requestedChannels(): array;
}

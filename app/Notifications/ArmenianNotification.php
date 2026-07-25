<?php

namespace App\Notifications;

use App\Contracts\Notifications\AuditableNotification;
use App\Services\Notifications\NotificationChannelRouter;
use App\Services\Notifications\NotificationLogRecorder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Throwable;

abstract class ArmenianNotification extends Notification implements AuditableNotification, ShouldQueueAfterCommit
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

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->mailSubject($notifiable))
            ->view('mail.armenian-notification', [
                'title' => $this->mailTitle($notifiable),
                'body' => $this->mailBody($notifiable),
                'actionText' => $this->mailActionText($notifiable),
                'actionUrl' => $this->mailActionUrl($notifiable),
            ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->auditContext()['payload'] ?? [];
    }

    public function failed(Throwable $exception): void
    {
        app(NotificationLogRecorder::class)->queuedNotificationFailed($this, $exception);
    }

    /**
     * @return array<int, string>
     */
    protected function requestedChannels(): array
    {
        return ['mail'];
    }

    abstract protected function mailSubject(object $notifiable): string;

    abstract protected function mailTitle(object $notifiable): string;

    abstract protected function mailBody(object $notifiable): string;

    protected function mailActionText(object $notifiable): ?string
    {
        return null;
    }

    protected function mailActionUrl(object $notifiable): ?string
    {
        return null;
    }
}

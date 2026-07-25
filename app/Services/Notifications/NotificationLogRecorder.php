<?php

namespace App\Services\Notifications;

use App\Contracts\Notifications\AuditableNotification;
use App\Models\NotificationLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Throwable;

class NotificationLogRecorder
{
    public function sending(
        object $notifiable,
        Notification&AuditableNotification $notification,
        string $channel
    ): void {
        $this->record($notifiable, $notification, $channel, 'sending');
    }

    public function sent(
        object $notifiable,
        Notification&AuditableNotification $notification,
        string $channel
    ): void {
        $this->record($notifiable, $notification, $channel, 'sent');
    }

    public function failed(
        object $notifiable,
        Notification&AuditableNotification $notification,
        string $channel,
        string $error
    ): void {
        $this->record($notifiable, $notification, $channel, 'failed', $error);
    }

    public function queuedNotificationFailed(
        Notification&AuditableNotification $notification,
        Throwable $exception
    ): void {
        if (empty($notification->id)) {
            return;
        }

        NotificationLog::query()
            ->where('notification_id', $notification->id)
            ->where('status', '!=', 'sent')
            ->update([
                'status' => 'failed',
                'error' => $this->limitError($exception->getMessage()),
                'failed_at' => now(),
                'updated_at' => now(),
            ]);
    }

    private function record(
        object $notifiable,
        Notification&AuditableNotification $notification,
        string $channel,
        string $status,
        ?string $error = null
    ): void {
        if (empty($notification->id)) {
            return;
        }

        $context = $notification->auditContext();
        $recipient = $this->recipient($notifiable, $notification, $channel);
        $identity = $this->notifiableIdentity($notifiable);
        $channelName = $this->channelName($channel);

        $log = NotificationLog::query()->firstOrNew([
            'notification_id' => $notification->id,
            'channel' => $channelName,
            'recipient_key' => hash('sha256', $identity['key'].'|'.$channelName.'|'.$recipient),
        ]);

        if ($log->exists && $log->status === 'sent' && $status !== 'sent') {
            return;
        }

        $log->fill([
            'notification_type' => $notification::class,
            'event_type' => $context['event_type'] ?? null,
            'notifiable_type' => $identity['type'],
            'notifiable_id' => $identity['id'],
            'recipient' => Str::limit($recipient, 255, ''),
            'subject_type' => $context['subject_type'] ?? null,
            'subject_id' => isset($context['subject_id']) ? (string) $context['subject_id'] : null,
            'status' => $status,
            'payload' => $context['payload'] ?? null,
            'error' => $error === null ? null : $this->limitError($error),
            'sent_at' => $status === 'sent' ? now() : null,
            'failed_at' => $status === 'failed' ? now() : null,
        ])->save();
    }

    /**
     * @return array{type: string|null, id: string|null, key: string}
     */
    private function notifiableIdentity(object $notifiable): array
    {
        if ($notifiable instanceof Model) {
            $id = $notifiable->getKey();

            return [
                'type' => $notifiable::class,
                'id' => $id === null ? null : (string) $id,
                'key' => $notifiable::class.':'.($id ?? 'unsaved'),
            ];
        }

        return [
            'type' => $notifiable::class,
            'id' => null,
            'key' => $notifiable::class,
        ];
    }

    private function recipient(
        object $notifiable,
        Notification $notification,
        string $channel
    ): string {
        if (! method_exists($notifiable, 'routeNotificationFor')) {
            return '';
        }

        $route = $notifiable instanceof AnonymousNotifiable
            ? $notifiable->routeNotificationFor($channel)
            : $notifiable->routeNotificationFor($channel, $notification);

        if (is_string($route) || is_numeric($route)) {
            return (string) $route;
        }

        return json_encode($route, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '';
    }

    private function limitError(string $error): string
    {
        return Str::limit($error, 5000, '');
    }

    private function channelName(string $driver): string
    {
        foreach (config('notifications.channels', []) as $channel => $settings) {
            if (($settings['driver'] ?? null) === $driver) {
                return $channel;
            }
        }

        return $driver;
    }
}

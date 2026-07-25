<?php

namespace App\Notifications;

use App\Contracts\Notifications\SendsTelegramChannelMessage;
use App\Models\Estate;
use App\Models\NotificationLog;
use App\Notifications\Messages\TelegramChannelMessage;
use App\Services\Notifications\EstateTelegramMessageFactory;

class EstateTelegramChannelNotification extends AuditableQueuedNotification implements SendsTelegramChannelMessage
{
    public const EVENT_TYPE = 'estate.published.telegram-channel';

    public array $backoff = [30, 120, 300];

    public function __construct(public Estate $estate) {}

    public function toTelegramChannel(object $notifiable): TelegramChannelMessage
    {
        return app(EstateTelegramMessageFactory::class)->make($this->estate);
    }

    public function shouldSend(object $notifiable, string $channel): bool
    {
        return ! NotificationLog::query()
            ->where('event_type', self::EVENT_TYPE)
            ->where('subject_type', 'estate')
            ->where('subject_id', (string) $this->estate->getKey())
            ->where('status', 'sent')
            ->exists();
    }

    public function auditContext(): array
    {
        return [
            'event_type' => self::EVENT_TYPE,
            'subject_type' => 'estate',
            'subject_id' => $this->estate->getKey(),
            'payload' => [
                'estate_id' => $this->estate->getKey(),
                'code' => $this->estate->code,
                'estate_status_id' => $this->estate->estate_status_id,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->auditContext()['payload'];
    }

    /**
     * @return array<int, string>
     */
    protected function requestedChannels(): array
    {
        return ['telegram-channel'];
    }
}

<?php

namespace App\Notifications\Channels;

use App\Contracts\Notifications\SendsTelegramChannelMessage;
use App\Services\Notifications\TelegramChannelClient;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use RuntimeException;

class TelegramChannel
{
    public function __construct(private readonly TelegramChannelClient $client) {}

    /**
     * @return array<string, mixed>
     */
    public function send(object $notifiable, Notification $notification): array
    {
        if (! $notification instanceof SendsTelegramChannelMessage) {
            throw new RuntimeException('Notification does not provide a Telegram channel message.');
        }

        $chatId = $notifiable instanceof AnonymousNotifiable
            ? $notifiable->routeNotificationFor(self::class)
            : $notifiable->routeNotificationFor(self::class, $notification);

        return $this->client->send(
            (string) $chatId,
            $notification->toTelegramChannel($notifiable)
        );
    }
}

<?php

namespace App\Listeners\Notifications;

use App\Events\EstateCreated;
use App\Events\EstatePublished;
use App\Notifications\Channels\TelegramChannel;
use App\Notifications\EstateTelegramChannelNotification;
use App\Services\Notifications\EstateTelegramPublicationPolicy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class QueueEstateTelegramChannelNotification
{
    public function __construct(
        private readonly EstateTelegramPublicationPolicy $publicationPolicy
    ) {}

    public function handle(EstateCreated|EstatePublished $event): void
    {
        if (! config('notifications.channels.telegram-channel.enabled')
            || ! $this->publicationPolicy->isReady($event->estate)) {
            return;
        }

        $chatId = (string) config('notifications.channels.telegram-channel.chat_id');
        $token = (string) config('notifications.channels.telegram-channel.bot_token');

        if ($chatId === '' || $token === '') {
            Log::warning('Telegram channel notifications are enabled but credentials are missing.');

            return;
        }

        Notification::route(TelegramChannel::class, $chatId)
            ->notify(new EstateTelegramChannelNotification($event->estate));
    }
}

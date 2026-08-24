<?php

namespace App\Listeners\Notifications;

use App\Events\EstatePriceChanged;
use App\Events\EstateRefundPercentageChanged;
use App\Notifications\Channels\TelegramChannel;
use App\Notifications\EstateTelegramChangeNotification;
use App\Services\Notifications\EstateTelegramPublicationPolicy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class QueueEstateTelegramChangeNotification
{
    public function __construct(
        private readonly EstateTelegramPublicationPolicy $publicationPolicy
    ) {}

    public function handle(EstatePriceChanged|EstateRefundPercentageChanged $event): void
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

        $notification = $event instanceof EstatePriceChanged
            ? EstateTelegramChangeNotification::forPrice(
                $event->estate,
                $event->previousPriceAmd,
                $event->priceAmd
            )
            : EstateTelegramChangeNotification::forRefundPercentage(
                $event->estate,
                $event->previousRefundPercentage,
                $event->refundPercentage
            );

        Notification::route(TelegramChannel::class, $chatId)
            ->notify($notification);
    }
}

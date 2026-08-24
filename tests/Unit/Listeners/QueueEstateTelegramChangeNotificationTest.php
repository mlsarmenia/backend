<?php

namespace Tests\Unit\Listeners;

use App\Events\EstatePriceChanged;
use App\Events\EstateRefundPercentageChanged;
use App\Listeners\Notifications\QueueEstateTelegramChangeNotification;
use App\Models\Estate;
use App\Notifications\Channels\TelegramChannel;
use App\Notifications\EstateTelegramChangeNotification;
use Illuminate\Notifications\SendQueuedNotifications;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class QueueEstateTelegramChangeNotificationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('notifications.channels.telegram-channel.enabled', true);
        config()->set('notifications.channels.telegram-channel.driver', TelegramChannel::class);
        config()->set('notifications.channels.telegram-channel.bot_token', 'test-token');
        config()->set('notifications.channels.telegram-channel.chat_id', '-1001234567890');
        config()->set('notifications.channels.telegram-channel.estate_status_ids', [3, 4]);
    }

    public function test_it_queues_price_and_refund_change_notifications(): void
    {
        Queue::fake();
        $estate = $this->estate(3);
        $listener = app(QueueEstateTelegramChangeNotification::class);

        $listener->handle(new EstatePriceChanged($estate, 56_500_000, 55_500_000));
        $listener->handle(new EstateRefundPercentageChanged($estate, 1.8, 2));

        Queue::assertPushed(
            SendQueuedNotifications::class,
            fn (SendQueuedNotifications $job): bool => $job->notification
                instanceof EstateTelegramChangeNotification
                && $job->notification->change === EstateTelegramChangeNotification::PRICE_CHANGED
                && $job->notification->previousValue === 56_500_000
                && $job->notification->value === 55_500_000
                && $job->channels === [TelegramChannel::class]
                && $job->queue === 'notifications'
                && $job->notifiables->first()->routeNotificationFor(TelegramChannel::class)
                    === '-1001234567890'
        );
        Queue::assertPushed(
            SendQueuedNotifications::class,
            fn (SendQueuedNotifications $job): bool => $job->notification
                instanceof EstateTelegramChangeNotification
                && $job->notification->change
                    === EstateTelegramChangeNotification::REFUND_PERCENTAGE_CHANGED
                && (float) $job->notification->previousValue === 1.8
                && (float) $job->notification->value === 2.0
        );
    }

    public function test_it_does_not_queue_for_drafts_or_when_disabled(): void
    {
        Queue::fake();
        $listener = app(QueueEstateTelegramChangeNotification::class);

        $listener->handle(new EstatePriceChanged($this->estate(1), 56_500_000, 55_500_000));
        Queue::assertNothingPushed();

        config()->set('notifications.channels.telegram-channel.enabled', false);

        $listener->handle(new EstatePriceChanged($this->estate(3), 56_500_000, 55_500_000));
        Queue::assertNothingPushed();
    }

    private function estate(int $statusId): Estate
    {
        return (new Estate)->forceFill([
            'id' => 12,
            'code' => '012-12',
            'estate_status_id' => $statusId,
            'is_published' => false,
        ]);
    }
}

<?php

namespace Tests\Unit\Listeners;

use App\Events\EstateCreated;
use App\Listeners\Notifications\QueueEstateTelegramChannelNotification;
use App\Models\Estate;
use App\Notifications\Channels\TelegramChannel;
use App\Notifications\EstateTelegramChannelNotification;
use Illuminate\Notifications\SendQueuedNotifications;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class QueueEstateTelegramChannelNotificationTest extends TestCase
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

    public function test_it_queues_a_channel_notification_for_a_publishable_estate(): void
    {
        Queue::fake();
        $estate = $this->estate(3);

        app(QueueEstateTelegramChannelNotification::class)->handle(
            new EstateCreated($estate)
        );

        Queue::assertPushed(
            SendQueuedNotifications::class,
            fn (SendQueuedNotifications $job): bool => $job->notification
                instanceof EstateTelegramChannelNotification
                && $job->notification->estate === $estate
                && $job->channels === [TelegramChannel::class]
                && $job->queue === 'notifications'
                && $job->notifiables->first()->routeNotificationFor(TelegramChannel::class)
                    === '-1001234567890'
        );
    }

    public function test_it_does_not_queue_draft_or_disabled_notifications(): void
    {
        Queue::fake();

        app(QueueEstateTelegramChannelNotification::class)->handle(
            new EstateCreated($this->estate(1))
        );
        Queue::assertNothingPushed();

        config()->set('notifications.channels.telegram-channel.enabled', false);

        app(QueueEstateTelegramChannelNotification::class)->handle(
            new EstateCreated($this->estate(3))
        );
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

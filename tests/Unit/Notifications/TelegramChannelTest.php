<?php

namespace Tests\Unit\Notifications;

use App\Contracts\Notifications\SendsTelegramChannelMessage;
use App\Notifications\Channels\TelegramChannel;
use App\Notifications\Messages\TelegramChannelMessage;
use App\Services\Notifications\TelegramChannelClient;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Notifications\Notification;
use Mockery;
use Tests\TestCase;

class TelegramChannelTest extends TestCase
{
    public function test_the_channel_delivers_an_on_demand_message(): void
    {
        $message = new TelegramChannelMessage(text: 'Estate');
        $client = Mockery::mock(TelegramChannelClient::class);
        $client->shouldReceive('send')
            ->once()
            ->with('-1001234567890', $message)
            ->andReturn(['message_id' => 91]);

        $recipient = (new AnonymousNotifiable)
            ->route(TelegramChannel::class, '-1001234567890');
        $notification = new TelegramChannelTestNotification($message);

        $response = (new TelegramChannel($client))->send($recipient, $notification);

        $this->assertSame(['message_id' => 91], $response);
    }

    public function test_laravel_can_resolve_the_custom_channel_driver(): void
    {
        $channel = app(ChannelManager::class)->driver(TelegramChannel::class);

        $this->assertInstanceOf(TelegramChannel::class, $channel);
    }
}

class TelegramChannelTestNotification extends Notification implements SendsTelegramChannelMessage
{
    public function __construct(private readonly TelegramChannelMessage $message) {}

    public function toTelegramChannel(object $notifiable): TelegramChannelMessage
    {
        return $this->message;
    }
}

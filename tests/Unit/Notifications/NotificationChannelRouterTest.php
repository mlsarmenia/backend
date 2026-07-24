<?php

namespace Tests\Unit\Notifications;

use App\Services\Notifications\NotificationChannelRouter;
use Illuminate\Notifications\AnonymousNotifiable;
use Tests\TestCase;

class NotificationChannelRouterTest extends TestCase
{
    public function test_it_routes_mail_only_when_the_channel_and_recipient_are_configured(): void
    {
        config()->set('notifications.channels.mail', [
            'enabled' => true,
            'driver' => 'mail',
        ]);

        $recipient = (new AnonymousNotifiable)->route('mail', 'broker@example.com');
        $router = new NotificationChannelRouter;

        $this->assertSame(['mail'], $router->route($recipient, ['mail']));
        $this->assertSame([], $router->route(new AnonymousNotifiable, ['mail']));

        config()->set('notifications.channels.mail.enabled', false);

        $this->assertSame([], $router->route($recipient, ['mail']));
    }

    public function test_unimplemented_telegram_placeholders_cannot_be_selected(): void
    {
        config()->set('notifications.channels.telegram-channel', [
            'enabled' => true,
            'driver' => null,
        ]);
        config()->set('notifications.channels.telegram-bot', [
            'enabled' => true,
            'driver' => null,
        ]);

        $channels = (new NotificationChannelRouter)->route(
            new AnonymousNotifiable,
            ['telegram-channel', 'telegram-bot']
        );

        $this->assertSame([], $channels);
    }
}

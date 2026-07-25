<?php

namespace Tests\Unit\Notifications;

use App\Contracts\Notifications\AuditableNotification;
use App\Models\NotificationLog;
use App\Notifications\ArmenianNotification;
use App\Notifications\Channels\TelegramChannel;
use App\Notifications\EstateTelegramChannelNotification;
use App\Notifications\Messages\TelegramChannelMessage;
use App\Services\Notifications\EstateTelegramMessageFactory;
use App\Services\Notifications\NotificationLogRecorder;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Mockery;
use RuntimeException;
use Tests\TestCase;

class NotificationLogRecorderTest extends TestCase
{
    private object $migration;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.default', 'notification_testing');
        config()->set('database.connections.notification_testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        DB::purge('notification_testing');
        DB::setDefaultConnection('notification_testing');

        $this->migration = require database_path(
            'migrations/2026_07_25_000002_create_notification_log_table.php'
        );
        $this->migration->up();
    }

    protected function tearDown(): void
    {
        $this->migration->down();
        DB::purge('notification_testing');

        parent::tearDown();
    }

    public function test_it_records_sending_and_sent_states_for_one_delivery(): void
    {
        $recipient = (new AnonymousNotifiable)->route('mail', 'broker@example.com');
        $notification = new AuditedTestNotification;
        $notification->id = 'f6df6e71-0d4f-4c5c-b963-278d20f71754';
        $recorder = new NotificationLogRecorder;

        $recorder->sending($recipient, $notification, 'mail');
        $recorder->sent($recipient, $notification, 'mail');

        $log = NotificationLog::query()->sole();

        $this->assertSame('sent', $log->status);
        $this->assertSame('broker@example.com', $log->recipient);
        $this->assertSame('estate.created', $log->event_type);
        $this->assertSame('estate', $log->subject_type);
        $this->assertSame('12', $log->subject_id);
        $this->assertSame(['estate_id' => 12], $log->payload);
        $this->assertNotNull($log->sent_at);
        $this->assertNull($log->failed_at);
    }

    public function test_laravel_notification_delivery_renders_mail_and_writes_the_audit_log(): void
    {
        config()->set('mail.default', 'array');
        config()->set('notifications.channels.mail', [
            'enabled' => true,
            'driver' => 'mail',
        ]);

        $recipient = (new AnonymousNotifiable)->route('mail', 'broker@example.com');
        $recipient->notifyNow(new DeliverableTestNotification);

        $log = NotificationLog::query()->sole();

        $this->assertSame('sent', $log->status);
        $this->assertSame('mail', $log->channel);
        $this->assertSame('broker@example.com', $log->recipient);
        $this->assertNotNull($log->sent_at);
    }

    public function test_it_marks_a_queued_transport_exception_as_failed(): void
    {
        $recipient = (new AnonymousNotifiable)->route('mail', 'broker@example.com');
        $notification = new AuditedTestNotification;
        $notification->id = '1a54d25b-cfb8-4f77-aa95-5384fa6a2874';
        $recorder = new NotificationLogRecorder;

        $recorder->sending($recipient, $notification, 'mail');
        $recorder->queuedNotificationFailed($notification, new RuntimeException('SMTP unavailable'));

        $log = NotificationLog::query()->sole();

        $this->assertSame('failed', $log->status);
        $this->assertSame('SMTP unavailable', $log->error);
        $this->assertNotNull($log->failed_at);
    }

    public function test_it_records_a_friendly_name_for_the_custom_telegram_driver(): void
    {
        config()->set(
            'notifications.channels.telegram-channel.driver',
            TelegramChannel::class
        );
        $recipient = (new AnonymousNotifiable)
            ->route(TelegramChannel::class, '-1001234567890');
        $notification = new AuditedTestNotification;
        $notification->id = '2be6f32f-c2d5-44a0-9221-0a147974a43b';

        (new NotificationLogRecorder)->sending(
            $recipient,
            $notification,
            TelegramChannel::class
        );

        $log = NotificationLog::query()->sole();

        $this->assertSame('telegram-channel', $log->channel);
        $this->assertSame('-1001234567890', $log->recipient);
    }

    public function test_sent_estate_channel_post_prevents_duplicate_delivery(): void
    {
        NotificationLog::query()->create([
            'notification_id' => '5d28a4bb-a286-47ba-b733-62b2fbd28126',
            'notification_type' => EstateTelegramChannelNotification::class,
            'event_type' => EstateTelegramChannelNotification::EVENT_TYPE,
            'recipient_key' => hash('sha256', 'channel'),
            'subject_type' => 'estate',
            'subject_id' => '12',
            'channel' => 'telegram-channel',
            'status' => 'sent',
        ]);

        $notification = new EstateTelegramChannelNotification(
            (new \App\Models\Estate)->forceFill(['id' => 12])
        );

        $this->assertFalse(
            $notification->shouldSend(new AnonymousNotifiable, TelegramChannel::class)
        );
    }

    public function test_custom_telegram_delivery_uses_laravel_lifecycle_auditing(): void
    {
        config()->set('notifications.channels.telegram-channel', [
            'enabled' => true,
            'driver' => TelegramChannel::class,
            'bot_token' => 'test-token',
            'chat_id' => '-1001234567890',
            'api_base_url' => 'https://api.telegram.test',
            'timeout' => 2,
            'request_attempts' => 1,
            'retry_delay_ms' => 0,
        ]);
        Http::fake([
            'https://api.telegram.test/*' => Http::response([
                'ok' => true,
                'result' => ['message_id' => 91],
            ]),
        ]);

        $factory = Mockery::mock(EstateTelegramMessageFactory::class);
        $factory->shouldReceive('make')
            ->once()
            ->andReturn(new TelegramChannelMessage(text: 'Estate'));
        app()->instance(EstateTelegramMessageFactory::class, $factory);

        $recipient = (new AnonymousNotifiable)
            ->route(TelegramChannel::class, '-1001234567890');
        $recipient->notifyNow(new EstateTelegramChannelNotification(
            (new \App\Models\Estate)->forceFill([
                'id' => 12,
                'code' => '012-12',
                'estate_status_id' => 3,
            ])
        ));

        $log = NotificationLog::query()->sole();

        $this->assertSame('sent', $log->status);
        $this->assertSame('telegram-channel', $log->channel);
        $this->assertSame('-1001234567890', $log->recipient);
        $this->assertSame(EstateTelegramChannelNotification::EVENT_TYPE, $log->event_type);
    }
}

class AuditedTestNotification extends Notification implements AuditableNotification
{
    public function auditContext(): array
    {
        return [
            'event_type' => 'estate.created',
            'subject_type' => 'estate',
            'subject_id' => 12,
            'payload' => ['estate_id' => 12],
        ];
    }
}

class DeliverableTestNotification extends ArmenianNotification
{
    public function auditContext(): array
    {
        return [
            'event_type' => 'estate.created',
            'subject_type' => 'estate',
            'subject_id' => 12,
            'payload' => ['estate_id' => 12],
        ];
    }

    protected function mailSubject(object $notifiable): string
    {
        return 'Նոր գույք';
    }

    protected function mailTitle(object $notifiable): string
    {
        return 'Ստեղծվել է նոր գույք';
    }

    protected function mailBody(object $notifiable): string
    {
        return 'Գույքի կոդը՝ 012-12։';
    }
}

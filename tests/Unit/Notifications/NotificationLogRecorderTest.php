<?php

namespace Tests\Unit\Notifications;

use App\Contracts\Notifications\AuditableNotification;
use App\Models\NotificationLog;
use App\Notifications\ArmenianNotification;
use App\Services\Notifications\NotificationLogRecorder;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
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

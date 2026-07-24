<?php

namespace Tests\Unit\Notifications;

use App\Notifications\ArmenianNotification;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Notifications\AnonymousNotifiable;
use Tests\TestCase;

class ArmenianNotificationTest extends TestCase
{
    public function test_it_builds_an_armenian_mail_view_on_the_notification_queue(): void
    {
        config()->set('notifications.queue', 'notifications');
        config()->set('notifications.channels.mail', [
            'enabled' => true,
            'driver' => 'mail',
        ]);

        $recipient = (new AnonymousNotifiable)->route('mail', 'broker@example.com');
        $notification = new ExampleArmenianNotification;
        $mail = $notification->toMail($recipient);

        $this->assertInstanceOf(ShouldQueueAfterCommit::class, $notification);
        $this->assertSame(['mail'], $notification->via($recipient));
        $this->assertSame(['mail' => 'notifications'], $notification->viaQueues());
        $this->assertSame('Նոր համապատասխանող գույք', $mail->subject);
        $this->assertSame('mail.armenian-notification', $mail->view);
        $this->assertSame('Դիտել գույքը', $mail->viewData['actionText']);
        $this->assertSame('https://mlsapp.am/admin/estate/12/show', $mail->viewData['actionUrl']);
    }
}

class ExampleArmenianNotification extends ArmenianNotification
{
    public function auditContext(): array
    {
        return [
            'event_type' => 'estate.matched',
            'subject_type' => 'estate',
            'subject_id' => 12,
            'payload' => ['estate_id' => 12],
        ];
    }

    protected function mailSubject(object $notifiable): string
    {
        return 'Նոր համապատասխանող գույք';
    }

    protected function mailTitle(object $notifiable): string
    {
        return 'Ձեր հաճախորդի համար գտնվել է գույք';
    }

    protected function mailBody(object $notifiable): string
    {
        return 'Բացեք գույքի էջը՝ մանրամասները դիտելու համար։';
    }

    protected function mailActionText(object $notifiable): ?string
    {
        return 'Դիտել գույքը';
    }

    protected function mailActionUrl(object $notifiable): ?string
    {
        return 'https://mlsapp.am/admin/estate/12/show';
    }
}

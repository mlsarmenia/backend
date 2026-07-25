<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

abstract class ArmenianNotification extends AuditableQueuedNotification
{
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->mailSubject($notifiable))
            ->view('mail.armenian-notification', [
                'title' => $this->mailTitle($notifiable),
                'body' => $this->mailBody($notifiable),
                'actionText' => $this->mailActionText($notifiable),
                'actionUrl' => $this->mailActionUrl($notifiable),
            ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->auditContext()['payload'] ?? [];
    }

    /**
     * @return array<int, string>
     */
    protected function requestedChannels(): array
    {
        return ['mail'];
    }

    abstract protected function mailSubject(object $notifiable): string;

    abstract protected function mailTitle(object $notifiable): string;

    abstract protected function mailBody(object $notifiable): string;

    protected function mailActionText(object $notifiable): ?string
    {
        return null;
    }

    protected function mailActionUrl(object $notifiable): ?string
    {
        return null;
    }
}

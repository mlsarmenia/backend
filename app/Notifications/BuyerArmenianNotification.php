<?php

namespace App\Notifications;

use App\Models\NotificationLog;
use Illuminate\Notifications\AnonymousNotifiable;

abstract class BuyerArmenianNotification extends ArmenianNotification
{
    /**
     * @param  array<string, int|string|null>  $buyer
     */
    public function __construct(public array $buyer) {}

    protected function buyerDetails(): string
    {
        $lines = [
            'Գնորդ՝ '.$this->buyer['name'],
            $this->line('Հեռախոս', $this->buyer['phone'] ?? null),
            $this->line('Էլ. հասցե', $this->buyer['email'] ?? null),
            $this->line('Գույքի տեսակ', $this->buyer['estate_type'] ?? null),
            $this->line('Գործարքի տեսակ', $this->buyer['contract_type'] ?? null),
            $this->line('Տարածք', $this->buyer['location'] ?? null),
            $this->line('Բյուջե', $this->buyer['budget'] ?? null),
            $this->line('Մակերես', $this->buyer['area'] ?? null),
            $this->line('Սենյակներ', $this->buyer['rooms'] ?? null),
        ];

        return collect($lines)->filter()->implode(PHP_EOL);
    }

    protected function alreadySentTo(
        object $notifiable,
        string $eventType
    ): bool {
        $recipient = $this->mailRecipient($notifiable);

        if ($recipient === null) {
            return false;
        }

        return NotificationLog::query()
            ->where('event_type', $eventType)
            ->where('subject_type', 'buyer')
            ->where('subject_id', (string) $this->buyer['id'])
            ->where('recipient', $recipient)
            ->where('status', 'sent')
            ->exists();
    }

    private function line(string $label, int|string|null $value): ?string
    {
        return $value === null || $value === '' ? null : "{$label}՝ {$value}";
    }

    private function mailRecipient(object $notifiable): ?string
    {
        if (! method_exists($notifiable, 'routeNotificationFor')) {
            return null;
        }

        $route = $notifiable instanceof AnonymousNotifiable
            ? $notifiable->routeNotificationFor('mail')
            : $notifiable->routeNotificationFor('mail', $this);

        return is_string($route) ? strtolower(trim($route)) : null;
    }
}

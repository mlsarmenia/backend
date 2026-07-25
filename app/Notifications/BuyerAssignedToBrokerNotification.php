<?php

namespace App\Notifications;

class BuyerAssignedToBrokerNotification extends BuyerArmenianNotification
{
    public const EVENT_TYPE = 'buyer.broker-assigned';

    public array $backoff = [30, 120, 300];

    /**
     * @param  array<string, int|string|null>  $buyer
     * @param  array{broker_id: int, name: string, email: string}  $broker
     */
    public function __construct(array $buyer, public array $broker)
    {
        parent::__construct($buyer);
    }

    public function auditContext(): array
    {
        return [
            'event_type' => self::EVENT_TYPE,
            'subject_type' => 'buyer',
            'subject_id' => $this->buyer['id'],
            'payload' => [
                'buyer_id' => $this->buyer['id'],
                'contact_id' => $this->buyer['contact_id'],
                'broker_id' => $this->broker['broker_id'],
            ],
        ];
    }

    protected function mailSubject(object $notifiable): string
    {
        return 'Ձեզ նշանակել են նոր գնորդի գործակալ';
    }

    protected function mailTitle(object $notifiable): string
    {
        return 'Նոր գնորդ է նշանակվել ձեզ';
    }

    protected function mailBody(object $notifiable): string
    {
        return implode(PHP_EOL, [
            'Դուք նշանակվել եք որպես այս գնորդի գործակալ։',
            '',
            $this->buyerDetails(),
        ]);
    }

    protected function mailActionText(object $notifiable): ?string
    {
        return 'Դիտել գնորդին';
    }

    protected function mailActionUrl(object $notifiable): ?string
    {
        return $this->buyer['show_url'] ?? null;
    }
}

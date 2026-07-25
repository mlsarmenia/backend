<?php

namespace App\Notifications;

class BuyerMatchesBrokerEstatesNotification extends BuyerArmenianNotification
{
    public const EVENT_TYPE = 'buyer.created.matching-broker';

    public array $backoff = [30, 120, 300];

    /**
     * @param  array<string, int|string|null>  $buyer
     * @param  array{
     *     broker_id: int,
     *     name: string,
     *     email: string|null,
     *     match_count: int,
     *     estates: array<int, array<string, int|string|null>>
     * }  $broker
     */
    public function __construct(array $buyer, public array $broker)
    {
        parent::__construct($buyer);
    }

    public function shouldSend(object $notifiable, string $channel): bool
    {
        return ! $this->alreadySentTo($notifiable, self::EVENT_TYPE);
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
                'match_count' => $this->broker['match_count'],
                'estate_ids' => collect($this->broker['estates'])->pluck('id')->all(),
            ],
        ];
    }

    protected function mailSubject(object $notifiable): string
    {
        return 'Նոր գնորդը համապատասխանում է ձեր գույքին';
    }

    protected function mailTitle(object $notifiable): string
    {
        return 'Ձեր գույքի համար կա նոր համապատասխանող գնորդ';
    }

    protected function mailBody(object $notifiable): string
    {
        $lines = [
            $this->buyerDetails(),
            '',
            'Համապատասխանող գույքեր՝ '.$this->broker['match_count'],
        ];

        foreach ($this->broker['estates'] as $estate) {
            $details = collect([
                $estate['code'],
                $estate['estate_type'],
                $estate['location'],
                $estate['price'],
                $estate['area'],
            ])->filter()->implode(' | ');

            $lines[] = '- '.$details;
        }

        $remaining = $this->broker['match_count'] - count($this->broker['estates']);

        if ($remaining > 0) {
            $lines[] = "... և ևս {$remaining} գույք";
        }

        return implode(PHP_EOL, $lines);
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

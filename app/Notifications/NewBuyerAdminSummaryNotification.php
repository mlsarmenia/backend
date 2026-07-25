<?php

namespace App\Notifications;

class NewBuyerAdminSummaryNotification extends BuyerArmenianNotification
{
    public const EVENT_TYPE = 'buyer.created.admin-summary';

    public array $backoff = [30, 120, 300];

    /**
     * @param  array<string, int|string|null>  $buyer
     * @param  array<int, array{
     *     broker_id: int,
     *     name: string,
     *     email: string|null,
     *     match_count: int,
     *     estates: array<int, array<string, int|string|null>>
     * }>  $brokers
     */
    public function __construct(
        array $buyer,
        public int $totalMatchCount,
        public array $brokers
    ) {
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
                'match_count' => $this->totalMatchCount,
                'candidate_broker_ids' => collect($this->brokers)->pluck('broker_id')->all(),
            ],
        ];
    }

    protected function mailSubject(object $notifiable): string
    {
        return 'Նոր գնորդի գործակալի նշանակում';
    }

    protected function mailTitle(object $notifiable): string
    {
        return 'Նոր գնորդի համար ընտրեք գործակալ';
    }

    protected function mailBody(object $notifiable): string
    {
        $brokerLimit = max(
            1,
            (int) config('notifications.buyer_matches.broker_summary_limit', 20)
        );
        $brokers = collect($this->brokers)->take($brokerLimit);
        $lines = [
            $this->buyerDetails(),
            '',
            "Համապատասխանող գույքեր՝ {$this->totalMatchCount}",
            'Թեկնածու գործակալներ՝ '.count($this->brokers),
        ];

        foreach ($brokers as $broker) {
            $lines[] = "- {$broker['name']}՝ {$broker['match_count']} գույք";
        }

        $remaining = count($this->brokers) - $brokers->count();

        if ($remaining > 0) {
            $lines[] = "... և ևս {$remaining} գործակալ";
        }

        if ($this->brokers === []) {
            $lines[] = 'Համապատասխանող գույք ունեցող գործակալ չի գտնվել։';
        }

        return implode(PHP_EOL, $lines);
    }

    protected function mailActionText(object $notifiable): ?string
    {
        return 'Նշանակել գործակալ';
    }

    protected function mailActionUrl(object $notifiable): ?string
    {
        return $this->buyer['edit_url'] ?? null;
    }
}

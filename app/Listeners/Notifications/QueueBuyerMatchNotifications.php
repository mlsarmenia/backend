<?php

namespace App\Listeners\Notifications;

use App\Events\BuyerCreated;
use App\Notifications\BuyerMatchesBrokerEstatesNotification;
use App\Notifications\NewBuyerAdminSummaryNotification;
use App\Services\Notifications\BuyerMatchNotificationDataFactory;
use App\Services\Notifications\OfficeAdminRecipientResolver;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Support\Facades\Notification;

class QueueBuyerMatchNotifications implements ShouldQueueAfterCommit
{
    public int $tries = 3;

    public array $backoff = [30, 120, 300];

    public function __construct(
        private readonly BuyerMatchNotificationDataFactory $dataFactory,
        private readonly OfficeAdminRecipientResolver $adminRecipients
    ) {}

    public function viaQueue(BuyerCreated $event): string
    {
        return (string) config('notifications.queue', 'notifications');
    }

    public function withDelay(BuyerCreated $event): int
    {
        return max(
            0,
            (int) config('notifications.buyer_matches.delay_seconds', 5)
        );
    }

    public function handle(BuyerCreated $event): void
    {
        $data = $this->dataFactory->make($event->buyer);

        foreach ($data['brokers'] as $broker) {
            if ($broker['email'] === null) {
                continue;
            }

            Notification::route('mail', $broker['email'])
                ->notify(new BuyerMatchesBrokerEstatesNotification($data['buyer'], $broker));
        }

        foreach ($this->adminRecipients->forBuyer($event->buyer) as $email) {
            Notification::route('mail', $email)
                ->notify(new NewBuyerAdminSummaryNotification(
                    $data['buyer'],
                    $data['total_match_count'],
                    $data['brokers']
                ));
        }
    }
}

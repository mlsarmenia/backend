<?php

namespace App\Listeners\Notifications;

use App\Events\BrokerAssignmentChanged;
use App\Notifications\BuyerAssignedToBrokerNotification;
use App\Services\Notifications\BrokerNotificationRecipientResolver;
use App\Services\Notifications\BuyerMatchNotificationDataFactory;
use Illuminate\Support\Facades\Notification;

class QueueAssignedBrokerNotification
{
    public function __construct(
        private readonly BuyerMatchNotificationDataFactory $dataFactory,
        private readonly BrokerNotificationRecipientResolver $brokerRecipients
    ) {}

    public function handle(BrokerAssignmentChanged $event): void
    {
        if ($event->brokerId === null) {
            return;
        }

        $broker = $this->brokerRecipients->find($event->brokerId);

        if ($broker === null) {
            return;
        }

        Notification::route('mail', $broker['email'])
            ->notify(new BuyerAssignedToBrokerNotification(
                $this->dataFactory->buyer($event->buyer),
                $broker
            ));
    }
}

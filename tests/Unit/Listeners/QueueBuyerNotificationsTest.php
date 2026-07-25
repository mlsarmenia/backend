<?php

namespace Tests\Unit\Listeners;

use App\Events\BrokerAssignmentChanged;
use App\Events\BuyerCreated;
use App\Listeners\Notifications\QueueAssignedBrokerNotification;
use App\Listeners\Notifications\QueueBuyerMatchNotifications;
use App\Models\Client;
use App\Notifications\BuyerAssignedToBrokerNotification;
use App\Notifications\BuyerMatchesBrokerEstatesNotification;
use App\Notifications\NewBuyerAdminSummaryNotification;
use App\Services\Notifications\BrokerNotificationRecipientResolver;
use App\Services\Notifications\BuyerMatchNotificationDataFactory;
use App\Services\Notifications\OfficeAdminRecipientResolver;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Notifications\SendQueuedNotifications;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\TestCase;

class QueueBuyerNotificationsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('notifications.queue', 'notifications');
        config()->set('notifications.channels.mail', [
            'enabled' => true,
            'driver' => 'mail',
        ]);
        config()->set('notifications.buyer_matches.delay_seconds', 5);
    }

    public function test_buyer_created_event_queues_the_matching_listener_on_the_notification_queue(): void
    {
        Queue::fake();

        event(new BuyerCreated((new Client)->forceFill(['id' => 20])));

        Queue::assertPushedOn(
            'notifications',
            CallQueuedListener::class,
            fn (CallQueuedListener $job): bool => $job->class === QueueBuyerMatchNotifications::class
                && $job->afterCommit === true
        );
    }

    public function test_buyer_creation_queues_broker_and_office_admin_notifications(): void
    {
        Queue::fake();
        $buyer = (new Client)->forceFill(['id' => 20]);
        $data = $this->notificationData();

        $factory = Mockery::mock(BuyerMatchNotificationDataFactory::class);
        $factory->shouldReceive('make')->once()->with($buyer)->andReturn($data);

        $admins = Mockery::mock(OfficeAdminRecipientResolver::class);
        $admins->shouldReceive('forBuyer')
            ->once()
            ->with($buyer)
            ->andReturn(['admin@example.com']);

        $listener = new QueueBuyerMatchNotifications($factory, $admins);

        $this->assertInstanceOf(ShouldQueueAfterCommit::class, $listener);
        $this->assertSame('notifications', $listener->viaQueue(new BuyerCreated($buyer)));
        $this->assertSame(5, $listener->withDelay(new BuyerCreated($buyer)));

        $listener->handle(new BuyerCreated($buyer));

        Queue::assertPushed(SendQueuedNotifications::class, 2);
        Queue::assertPushed(
            SendQueuedNotifications::class,
            fn (SendQueuedNotifications $job): bool => $job->notification
                instanceof BuyerMatchesBrokerEstatesNotification
                && $this->recipient($job) === 'broker@example.com'
                && $job->queue === 'notifications'
        );
        Queue::assertPushed(
            SendQueuedNotifications::class,
            fn (SendQueuedNotifications $job): bool => $job->notification
                instanceof NewBuyerAdminSummaryNotification
                && $job->notification->totalMatchCount === 3
                && count($job->notification->brokers) === 2
                && $this->recipient($job) === 'admin@example.com'
                && $job->queue === 'notifications'
        );
    }

    public function test_broker_assignment_queues_the_selected_broker_notification(): void
    {
        Queue::fake();
        $buyer = (new Client)->forceFill(['id' => 20]);
        $buyerSummary = $this->notificationData()['buyer'];
        $broker = [
            'broker_id' => 11,
            'name' => 'Անի Մկրտչյան',
            'email' => 'broker@example.com',
        ];

        $factory = Mockery::mock(BuyerMatchNotificationDataFactory::class);
        $factory->shouldReceive('buyer')->once()->with($buyer)->andReturn($buyerSummary);

        $recipients = Mockery::mock(BrokerNotificationRecipientResolver::class);
        $recipients->shouldReceive('find')->once()->with(11)->andReturn($broker);

        (new QueueAssignedBrokerNotification($factory, $recipients))
            ->handle(new BrokerAssignmentChanged($buyer, null, 11));

        Queue::assertPushed(
            SendQueuedNotifications::class,
            fn (SendQueuedNotifications $job): bool => $job->notification
                instanceof BuyerAssignedToBrokerNotification
                && $job->notification->broker['broker_id'] === 11
                && $this->recipient($job) === 'broker@example.com'
                && $job->queue === 'notifications'
        );
    }

    public function test_removing_a_broker_does_not_queue_an_assignment_notification(): void
    {
        Queue::fake();
        $buyer = (new Client)->forceFill(['id' => 20]);
        $factory = Mockery::mock(BuyerMatchNotificationDataFactory::class);
        $factory->shouldNotReceive('buyer');
        $recipients = Mockery::mock(BrokerNotificationRecipientResolver::class);
        $recipients->shouldNotReceive('find');

        (new QueueAssignedBrokerNotification($factory, $recipients))
            ->handle(new BrokerAssignmentChanged($buyer, 11, null));

        Queue::assertNothingPushed();
    }

    private function recipient(SendQueuedNotifications $job): ?string
    {
        return $job->notifiables->first()?->routeNotificationFor('mail');
    }

    /**
     * @return array<string, mixed>
     */
    private function notificationData(): array
    {
        return [
            'buyer' => [
                'id' => 20,
                'contact_id' => 208,
                'name' => 'Լիլիթ Պետրոսյան',
                'phone' => '091000000',
                'email' => null,
                'estate_type' => 'Բնակարան',
                'contract_type' => 'Վաճառք',
                'location' => 'Երևան, Կենտրոն',
                'budget' => '30,000,000 - 40,000,000 AMD',
                'area' => '50 - 80 քմ',
                'rooms' => '2 - 3',
                'show_url' => 'https://mlsapp.am/admin/buyer/208/show?type=viewOnly',
                'edit_url' => 'https://mlsapp.am/admin/buyer/208/edit',
            ],
            'total_match_count' => 3,
            'brokers' => [
                [
                    'broker_id' => 11,
                    'name' => 'Անի Մկրտչյան',
                    'email' => 'broker@example.com',
                    'match_count' => 2,
                    'estates' => [
                        [
                            'id' => 101,
                            'code' => '012-101',
                            'estate_type' => 'Բնակարան',
                            'location' => 'Երևան, Կենտրոն',
                            'price' => '35,000,000 AMD',
                            'area' => '65 քմ',
                        ],
                    ],
                ],
                [
                    'broker_id' => 12,
                    'name' => 'Արամ Հակոբյան',
                    'email' => null,
                    'match_count' => 1,
                    'estates' => [],
                ],
            ],
        ];
    }
}

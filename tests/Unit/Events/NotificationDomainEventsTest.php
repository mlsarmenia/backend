<?php

namespace Tests\Unit\Events;

use App\Events\BrokerAssignmentChanged;
use App\Events\BuyerCreated;
use App\Events\EstateCreated;
use App\Events\EstatePublished;
use App\Models\Client;
use App\Models\Estate;
use App\Observers\ClientObserver;
use App\Observers\EstateObserver;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class NotificationDomainEventsTest extends TestCase
{
    public function test_domain_events_wait_for_the_database_transaction_to_commit(): void
    {
        $client = (new Client)->forceFill(['id' => 20]);
        $estate = (new Estate)->forceFill(['id' => 12]);

        $this->assertInstanceOf(ShouldDispatchAfterCommit::class, new BuyerCreated($client));
        $this->assertInstanceOf(
            ShouldDispatchAfterCommit::class,
            new BrokerAssignmentChanged($client, 5, 8)
        );
        $this->assertInstanceOf(ShouldDispatchAfterCommit::class, new EstateCreated($estate));
        $this->assertInstanceOf(ShouldDispatchAfterCommit::class, new EstatePublished($estate));
    }

    public function test_client_creation_dispatches_the_buyer_created_event(): void
    {
        Event::fake([BuyerCreated::class]);
        $client = (new Client)->forceFill(['id' => 20]);

        (new ClientObserver)->created($client);

        Event::assertDispatched(
            BuyerCreated::class,
            fn (BuyerCreated $event) => $event->buyer === $client
        );
    }

    public function test_broker_change_dispatches_previous_and_new_assignments(): void
    {
        Event::fake([BrokerAssignmentChanged::class]);

        $client = (new Client)->forceFill(['id' => 20, 'broker_id' => 5]);
        $client->syncOriginal();
        $client->broker_id = 8;
        $client->syncChanges();

        (new ClientObserver)->updated($client);

        Event::assertDispatched(
            BrokerAssignmentChanged::class,
            fn (BrokerAssignmentChanged $event) => $event->buyer === $client
                && $event->previousBrokerId === 5
                && $event->brokerId === 8
        );
    }

    public function test_unrelated_client_updates_do_not_dispatch_a_broker_event(): void
    {
        Event::fake([BrokerAssignmentChanged::class]);

        $client = (new Client)->forceFill(['id' => 20, 'broker_id' => 5]);
        $client->syncOriginal();
        $client->price_to = 50_000_000;
        $client->syncChanges();

        (new ClientObserver)->updated($client);

        Event::assertNotDispatched(BrokerAssignmentChanged::class);
    }

    public function test_estate_becoming_publishable_dispatches_the_published_event(): void
    {
        config()->set('notifications.channels.telegram-channel.estate_status_ids', [3, 4]);
        Event::fake([EstatePublished::class]);

        $estate = (new Estate)->forceFill([
            'id' => 12,
            'estate_status_id' => 1,
            'is_published' => false,
        ]);
        $estate->syncOriginal();
        $estate->estate_status_id = 3;
        $estate->syncChanges();

        (new EstateObserver)->updated($estate);

        Event::assertDispatched(
            EstatePublished::class,
            fn (EstatePublished $event): bool => $event->estate === $estate
        );
    }
}

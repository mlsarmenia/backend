<?php

namespace Tests\Unit\Events;

use App\Events\BrokerAssignmentChanged;
use App\Events\BuyerCreated;
use App\Events\EstateCreated;
use App\Events\EstatePriceChanged;
use App\Events\EstatePublished;
use App\Events\EstateRefundPercentageChanged;
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
        $this->assertInstanceOf(
            ShouldDispatchAfterCommit::class,
            new EstatePriceChanged($estate, 56_500_000, 55_500_000)
        );
        $this->assertInstanceOf(
            ShouldDispatchAfterCommit::class,
            new EstateRefundPercentageChanged($estate, 1.8, 2)
        );
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

    public function test_ready_estate_value_changes_dispatch_telegram_change_events(): void
    {
        config()->set('notifications.channels.telegram-channel.estate_status_ids', [3, 4]);
        Event::fake([EstatePriceChanged::class, EstateRefundPercentageChanged::class]);

        $estate = (new Estate)->forceFill([
            'id' => 12,
            'estate_status_id' => 3,
            'is_published' => false,
            'price_amd' => 56_500_000,
            'refund_percentage' => 1.8,
        ]);
        $estate->syncOriginal();
        $estate->price_amd = 55_500_000;
        $estate->refund_percentage = 2;
        $estate->syncChanges();

        (new EstateObserver)->updated($estate);

        Event::assertDispatched(
            EstatePriceChanged::class,
            fn (EstatePriceChanged $event): bool => $event->estate === $estate
                && (float) $event->previousPriceAmd === 56_500_000.0
                && (float) $event->priceAmd === 55_500_000.0
        );
        Event::assertDispatched(
            EstateRefundPercentageChanged::class,
            fn (EstateRefundPercentageChanged $event): bool => $event->estate === $estate
                && (float) $event->previousRefundPercentage === 1.8
                && (float) $event->refundPercentage === 2.0
        );
    }

    public function test_first_publication_does_not_dispatch_change_events(): void
    {
        config()->set('notifications.channels.telegram-channel.estate_status_ids', [3, 4]);
        Event::fake([
            EstatePriceChanged::class,
            EstateRefundPercentageChanged::class,
            EstatePublished::class,
        ]);

        $estate = (new Estate)->forceFill([
            'id' => 12,
            'estate_status_id' => 1,
            'is_published' => false,
            'price_amd' => 56_500_000,
            'refund_percentage' => 1.8,
        ]);
        $estate->syncOriginal();
        $estate->estate_status_id = 3;
        $estate->price_amd = 55_500_000;
        $estate->refund_percentage = 2;
        $estate->syncChanges();

        (new EstateObserver)->updated($estate);

        Event::assertNotDispatched(EstatePriceChanged::class);
        Event::assertNotDispatched(EstateRefundPercentageChanged::class);
        Event::assertDispatched(EstatePublished::class);
    }
}

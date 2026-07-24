<?php

namespace App\Observers;

use App\Events\BrokerAssignmentChanged;
use App\Events\BuyerCreated;
use App\Models\Client;

class ClientObserver
{
    public function created(Client $client): void
    {
        BuyerCreated::dispatch($client);
    }

    public function updated(Client $client): void
    {
        if (! $client->wasChanged('broker_id')) {
            return;
        }

        BrokerAssignmentChanged::dispatch(
            $client,
            $this->nullableInt($client->getRawOriginal('broker_id')),
            $this->nullableInt($client->broker_id)
        );
    }

    private function nullableInt(mixed $value): ?int
    {
        return $value === null || $value === '' ? null : (int) $value;
    }
}

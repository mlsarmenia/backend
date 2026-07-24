<?php

namespace App\Events;

use App\Models\Client;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BrokerAssignmentChanged implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Client $buyer,
        public ?int $previousBrokerId,
        public ?int $brokerId
    ) {}
}

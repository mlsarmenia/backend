<?php

namespace App\Events;

use App\Models\Estate;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EstateRefundPercentageChanged implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Estate $estate,
        public mixed $previousRefundPercentage,
        public mixed $refundPercentage
    ) {}
}

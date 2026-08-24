<?php

namespace App\Events;

use App\Models\Estate;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EstatePriceChanged implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Estate $estate,
        public mixed $previousPriceAmd,
        public mixed $priceAmd
    ) {}
}

<?php

namespace Tests\Unit\Models;

use App\Models\Estate;
use Tests\TestCase;

class EstateRefundTest extends TestCase
{
    public function test_refund_amount_and_display_are_calculated_from_amd_price(): void
    {
        $estate = new Estate([
            'price_amd' => 8_000_000,
            'refund_percentage' => 12.5,
        ]);

        $this->assertSame(1_000_000.0, $estate->refund_amount);
        $this->assertSame('12.5% / 1,000,000 AMD', $estate->refund_display);
    }

    public function test_empty_or_zero_refund_percentage_has_no_refund(): void
    {
        $estate = new Estate(['price_amd' => 8_000_000]);

        $this->assertNull($estate->refund_amount);
        $this->assertNull($estate->refund_display);

        $estate->refund_percentage = 0;

        $this->assertNull($estate->refund_amount);
        $this->assertNull($estate->refund_display);
    }
}

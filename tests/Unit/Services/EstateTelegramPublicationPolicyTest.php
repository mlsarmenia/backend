<?php

namespace Tests\Unit\Services;

use App\Models\Estate;
use App\Services\Notifications\EstateTelegramPublicationPolicy;
use Tests\TestCase;

class EstateTelegramPublicationPolicyTest extends TestCase
{
    public function test_public_or_publishable_estates_are_ready_for_the_channel(): void
    {
        config()->set('notifications.channels.telegram-channel.estate_status_ids', [3, 4]);
        $policy = new EstateTelegramPublicationPolicy;

        $this->assertFalse($policy->isReady($this->estate(1, false)));
        $this->assertFalse($policy->isReady($this->estate(2, false)));
        $this->assertTrue($policy->isReady($this->estate(3, false)));
        $this->assertTrue($policy->isReady($this->estate(4, false)));
        $this->assertTrue($policy->isReady($this->estate(1, true)));
    }

    public function test_it_detects_only_the_first_transition_into_a_publishable_state(): void
    {
        config()->set('notifications.channels.telegram-channel.estate_status_ids', [3, 4]);
        $policy = new EstateTelegramPublicationPolicy;

        $estate = $this->estate(1, false);
        $estate->syncOriginal();
        $estate->estate_status_id = 3;
        $estate->syncChanges();

        $this->assertTrue($policy->becameReady($estate));

        $estate = $this->estate(3, false);
        $estate->syncOriginal();
        $estate->estate_status_id = 4;
        $estate->syncChanges();

        $this->assertFalse($policy->becameReady($estate));
    }

    private function estate(int $statusId, bool $isPublished): Estate
    {
        return (new Estate)->forceFill([
            'id' => 12,
            'estate_status_id' => $statusId,
            'is_published' => $isPublished,
        ]);
    }
}

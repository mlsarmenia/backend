<?php

namespace Tests\Unit\Services;

use App\Models\CContractType;
use App\Models\CCurrency;
use App\Models\CEstateType;
use App\Models\Client;
use App\Models\CLocationCity;
use App\Models\CLocationCommunity;
use App\Models\CLocationProvince;
use App\Models\Contact;
use App\Models\Estate;
use App\Models\RealtorUser;
use App\Services\Notifications\BuyerMatchNotificationDataFactory;
use App\Services\PotentialEstateMatcher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\TestCase;

class BuyerMatchNotificationDataFactoryTest extends TestCase
{
    public function test_it_groups_matches_by_listing_broker_and_limits_estate_summaries(): void
    {
        config()->set('app.url', 'https://mlsapp.am');
        config()->set('backpack.base.route_prefix', 'admin');
        config()->set('notifications.buyer_matches.estate_summary_limit', 1);

        $buyer = $this->buyer();
        $brokerOne = $this->broker(11, 'Անի', 'Մկրտչյան', 'ANI@example.com');
        $brokerTwo = $this->broker(12, 'Արամ', 'Հակոբյան', null);
        $estates = new Collection([
            $this->estate(101, '012-101', $brokerOne),
            $this->estate(102, '012-102', $brokerOne),
            $this->estate(103, '012-103', $brokerTwo),
            $this->estate(104, '012-104', null),
        ]);

        $query = Mockery::mock(Builder::class);
        $query->shouldReceive('with')->once()->andReturnSelf();
        $query->shouldReceive('get')->once()->andReturn($estates);

        $matcher = Mockery::mock(PotentialEstateMatcher::class);
        $matcher->shouldReceive('forClient')->once()->with($buyer)->andReturn($query);

        $data = (new BuyerMatchNotificationDataFactory($matcher))->make($buyer);

        $this->assertSame(4, $data['total_match_count']);
        $this->assertCount(2, $data['brokers']);
        $this->assertSame(11, $data['brokers'][0]['broker_id']);
        $this->assertSame('ani@example.com', $data['brokers'][0]['email']);
        $this->assertSame(2, $data['brokers'][0]['match_count']);
        $this->assertCount(1, $data['brokers'][0]['estates']);
        $this->assertSame('012-101', $data['brokers'][0]['estates'][0]['code']);
        $this->assertNull($data['brokers'][1]['email']);
        $this->assertSame(
            'https://mlsapp.am/admin/buyer/208/edit',
            $data['buyer']['edit_url']
        );
    }

    private function buyer(): Client
    {
        $buyer = (new Client)->forceFill([
            'id' => 20,
            'contact_id' => 208,
            'price_from' => 30_000_000,
            'price_to' => 40_000_000,
            'area_from' => 50,
            'area_to' => 80,
            'room_count_from' => 2,
            'room_count_to' => 3,
        ]);

        $buyer->setRelations([
            'contact' => (new Contact)->forceFill([
                'id' => 208,
                'name_arm' => 'Լիլիթ',
                'last_name_arm' => 'Պետրոսյան',
                'phone_mobile_1' => '091000000',
            ]),
            'estate_type' => (new CEstateType)->forceFill([
                'id' => 1,
                'name_arm' => 'Բնակարան',
            ]),
            'contract_type' => (new CContractType)->forceFill([
                'id' => 1,
                'name_arm' => 'Վաճառք',
            ]),
            'location_province' => (new CLocationProvince)->forceFill([
                'id' => 1,
                'name_arm' => 'Երևան',
            ]),
            'location_city' => null,
            'communities' => new Collection([
                (new CLocationCommunity)->forceFill([
                    'id' => 8,
                    'name_arm' => 'Կենտրոն',
                ]),
            ]),
            'currency' => (new CCurrency)->forceFill([
                'id' => 1,
                'iso_code' => 'AMD',
            ]),
            'client_repairing_types' => new Collection,
            'client_building_project__types' => new Collection,
            'client_building_types' => new Collection,
        ]);

        return $buyer;
    }

    private function broker(
        int $id,
        string $firstName,
        string $lastName,
        ?string $email
    ): RealtorUser {
        $broker = (new RealtorUser)->forceFill(['id' => $id]);
        $broker->setRelations([
            'contact' => (new Contact)->forceFill([
                'name_arm' => $firstName,
                'last_name_arm' => $lastName,
                'email' => $email,
            ]),
            'user' => null,
        ]);

        return $broker;
    }

    private function estate(
        int $id,
        string $code,
        ?RealtorUser $broker
    ): Estate {
        $estate = (new Estate)->forceFill([
            'id' => $id,
            'code' => $code,
            'agent_id' => $broker?->getKey(),
            'price_amd' => '35000000',
            'area_total' => 65,
        ]);
        $estate->setRelations([
            'agent' => $broker,
            'estate_type' => (new CEstateType)->forceFill([
                'id' => 1,
                'name_arm' => 'Բնակարան',
            ]),
            'location_province' => (new CLocationProvince)->forceFill([
                'id' => 1,
                'name_arm' => 'Երևան',
            ]),
            'location_city' => (new CLocationCity)->forceFill([
                'id' => 1,
                'name_arm' => 'Երևան',
            ]),
            'location_community' => (new CLocationCommunity)->forceFill([
                'id' => 8,
                'name_arm' => 'Կենտրոն',
            ]),
        ]);

        return $estate;
    }
}

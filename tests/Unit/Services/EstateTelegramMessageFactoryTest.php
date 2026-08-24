<?php

namespace Tests\Unit\Services;

use App\Models\CContractType;
use App\Models\CEstateType;
use App\Models\CLocationCommunity;
use App\Models\CLocationProvince;
use App\Models\CLocationStreet;
use App\Models\Contact;
use App\Models\Estate;
use App\Models\EstateDocument;
use App\Models\Organization;
use App\Models\RealtorUser;
use App\Models\User;
use App\Services\Notifications\EstateTelegramMessageFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EstateTelegramMessageFactoryTest extends TestCase
{
    public function test_it_formats_estate_details_and_uses_the_main_image(): void
    {
        config()->set('app.url', 'https://mlsapp.am');
        Storage::fake('S3Public');
        Storage::disk('S3Public')->put('estate/photos/12/main.jpg', 'image');

        $estate = $this->estate([
            'main_image_file_path' => '12/main.jpg',
        ]);

        $message = (new EstateTelegramMessageFactory)->make($estate);

        $this->assertStringContainsString('<b>Կոդ՝</b> 012-12', $message->text);
        $this->assertStringContainsString('Բնակարան / Վաճառք', $message->text);
        $this->assertStringContainsString('Կենտրոն &lt;փորձ&gt;', $message->text);
        $this->assertStringContainsString('45,000,000 AMD / $116,000', $message->text);
        $this->assertStringContainsString('78.5 մ²', $message->text);
        $this->assertStringContainsString('<b>Գործակալություն՝</b> RED Invest group', $message->text);
        $this->assertStringContainsString('<b>Գործակալ՝</b> Անի Քոչարյան', $message->text);
        $this->assertStringContainsString('Աբովյան', $message->text);
        $this->assertStringNotContainsString('building-private-15', $message->text);
        $this->assertStringNotContainsString('apartment-private-8', $message->text);
        $this->assertStringContainsString('/admin/estate/12/show?type=viewOnly', $message->text);
        $this->assertStringContainsString('estate/photos/12/main.jpg', $message->photoUrl);
        $this->assertSame('Դիտել գույքը', $message->actionText);
    }

    public function test_it_formats_price_and_refund_change_directions(): void
    {
        $estate = $this->estate();
        $factory = new EstateTelegramMessageFactory;

        $priceDecrease = $factory->makePriceChanged($estate, 56_500_000, 55_500_000);
        $priceIncrease = $factory->makePriceChanged($estate, 55_500_000, 56_500_000);
        $refundIncrease = $factory->makeRefundPercentageChanged($estate, 1.8, 2);
        $refundDecrease = $factory->makeRefundPercentageChanged($estate, 2, 1.8);

        $this->assertStringContainsString('<b>Գնի փոփոխություն ❗</b>', $priceDecrease->text);
        $this->assertStringContainsString('🟢⬇️ 56,500,000 AMD-ից 55,500,000 AMD', $priceDecrease->text);
        $this->assertStringContainsString('🔴⬆️ 55,500,000 AMD-ից 56,500,000 AMD', $priceIncrease->text);
        $this->assertStringContainsString(
            '<b>Փոխհատուցման փոփոխություն ❗</b>',
            $refundIncrease->text
        );
        $this->assertStringContainsString('🟢⬆️ 1.8%-ից 2%', $refundIncrease->text);
        $this->assertStringContainsString('🔴⬇️ 2%-ից 1.8%', $refundDecrease->text);
        $this->assertStringContainsString('<b>Գործակալություն՝</b> RED Invest group', $priceDecrease->text);
        $this->assertStringContainsString('<b>Գործակալ՝</b> Անի Քոչարյան', $refundIncrease->text);
    }

    public function test_it_falls_back_to_the_first_estate_document(): void
    {
        Storage::fake('S3Public');
        Storage::disk('S3Public')->put('estate/photos/12/fallback.jpg', 'image');

        $estate = $this->estate();
        $estate->setRelation('estateDocuments', new Collection([
            (new EstateDocument)->forceFill([
                'estate_id' => 12,
                'path' => 'fallback.jpg',
                'is_public' => true,
            ]),
        ]));

        $message = (new EstateTelegramMessageFactory)->make($estate);

        $this->assertStringContainsString('estate/photos/12/fallback.jpg', $message->photoUrl);
    }

    private function estate(array $attributes = []): Estate
    {
        $estate = (new Estate)->forceFill(array_merge([
            'id' => 12,
            'code' => '012-12',
            'estate_type_id' => 1,
            'contract_type_id' => 1,
            'price_amd' => 45_000_000,
            'price_usd' => 116_000,
            'area_total' => 78.5,
            'address_building' => 'building-private-15',
            'address_apartment' => 'apartment-private-8',
        ], $attributes));

        $estate->setRelation(
            'estate_type',
            (new CEstateType)->forceFill(['id' => 1, 'name_arm' => 'Բնակարան'])
        );
        $estate->setRelation(
            'contract_type',
            (new CContractType)->forceFill(['id' => 1, 'name_arm' => 'Վաճառք'])
        );
        $estate->setRelation(
            'location_province',
            (new CLocationProvince)->forceFill(['id' => 1, 'name_arm' => 'Երևան'])
        );
        $estate->setRelation(
            'location_community',
            (new CLocationCommunity)->forceFill(['id' => 2, 'name_arm' => 'Կենտրոն <փորձ>'])
        );
        $estate->setRelation(
            'location_street',
            (new CLocationStreet)->forceFill(['id' => 3, 'name_arm' => 'Աբովյան'])
        );
        $organization = (new Organization)->forceFill([
            'id' => 4,
            'name' => 'RED Invest group',
        ]);
        $user = (new User)->forceFill(['id' => 5, 'organization_id' => 4]);
        $user->setRelation('organization', $organization);
        $agent = (new RealtorUser)->forceFill(['id' => 6, 'contact_id' => 7]);
        $agent->setRelation(
            'contact',
            (new Contact)->forceFill([
                'id' => 7,
                'name_arm' => 'Անի',
                'last_name_arm' => 'Քոչարյան',
            ])
        );
        $agent->setRelation('user', $user);
        $estate->setRelation('agent', $agent);
        $estate->setRelation('estateDocuments', new Collection);

        return $estate;
    }
}

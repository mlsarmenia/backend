<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\LandRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LandRequiredFieldsTest extends TestCase
{
    #[DataProvider('requiredFields')]
    public function test_it_requires_each_marked_land_field(string $field): void
    {
        $input = $this->validInput();
        unset($input[$field]);

        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has($field));
    }

    public function test_zero_is_a_valid_explicit_no_for_land_document_fields(): void
    {
        $this->assertFalse($this->validator($this->validInput())->fails());
    }

    public function test_land_document_fields_reject_values_other_than_yes_or_no(): void
    {
        foreach (['arch_project_package', 'arch_project', 'building_permit'] as $field) {
            $input = $this->validInput();
            $input[$field] = 2;

            $this->assertTrue($this->validator($input)->errors()->has($field));
        }
    }

    public function test_yerevan_requires_community_but_not_city(): void
    {
        $input = $this->validInput();
        $input['location_province'] = 1;
        $input['location_community'] = 5;
        unset($input['location_city']);

        $this->assertFalse($this->validator($input)->fails());

        unset($input['location_community']);
        $this->assertTrue($this->validator($input)->errors()->has('location_community'));
    }

    public function test_rental_requires_owner_but_not_seller(): void
    {
        $input = $this->validInput();
        $input['contract_type'] = 2;
        $input['owner'] = 1;
        unset($input['seller']);

        $this->assertFalse($this->validator($input)->fails());

        unset($input['owner']);
        $this->assertTrue($this->validator($input)->errors()->has('owner'));
    }

    public function test_it_requires_an_uploaded_photo_and_a_selected_main_photo(): void
    {
        $input = $this->validInput();
        $input['temporary_photos'] = '[]';
        $input['temporary_photos_main'] = '';
        $this->assertTrue($this->validator($input)->errors()->has('temporary_photos'));

        $input = $this->validInput();
        $input['temporary_photos_main'] = '';
        $this->assertTrue($this->validator($input)->errors()->has('temporary_photos'));

        $input['temporary_photos_main'] = 'uploads/tmp/other.jpg';
        $this->assertTrue($this->validator($input)->errors()->has('temporary_photos'));
    }

    public function test_existing_uploaded_photo_can_be_selected_on_edit(): void
    {
        $input = $this->validInput();
        $input['temporary_photos'] = json_encode([
            'estate/photos/12/front.jpg',
            'estate/photos/12/kitchen.jpg',
        ]);
        $input['temporary_photos_main'] = '12/kitchen.jpg';

        $this->assertFalse($this->validator($input)->fails());
    }

    public function test_front_length_accepts_decimals_but_not_negative_values(): void
    {
        $input = $this->validInput();
        $input['front_length'] = 12.5;
        $this->assertFalse($this->validator($input)->fails());

        $input['front_length'] = -1;
        $this->assertTrue($this->validator($input)->errors()->has('front_length'));
    }

    public static function requiredFields(): array
    {
        return [
            ['contract_type'],
            ['estate_status'],
            ['seller'],
            ['location_province'],
            ['location_city'],
            ['location_street'],
            ['area_total'],
            ['price_amd'],
            ['refund_percentage'],
            ['land_type'],
            ['land_structure_type'],
            ['fence_type'],
            ['front_with_street'],
            ['front_length'],
            ['arch_project_package'],
            ['arch_project'],
            ['building_permit'],
        ];
    }

    private function validator(array $input)
    {
        $request = LandRequest::create('/', 'POST', $input);

        return Validator::make($input, $request->rules());
    }

    private function validInput(): array
    {
        return [
            'estate_type_id' => 4,
            'contract_type' => 1,
            'estate_status' => 1,
            'seller' => 1,
            'location_province' => 2,
            'location_city' => 3,
            'location_street' => 4,
            'area_total' => 5000,
            'price_amd' => 50_000_000,
            'refund_percentage' => 2,
            'land_type' => 1,
            'land_structure_type' => 1,
            'fence_type' => 1,
            'front_with_street' => 1,
            'front_length' => 20,
            'arch_project_package' => 0,
            'arch_project' => 0,
            'building_permit' => 0,
            'temporary_photos' => json_encode(['uploads/tmp/front.jpg']),
            'temporary_photos_main' => 'uploads/tmp/front.jpg',
        ];
    }
}

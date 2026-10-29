<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\CommercialRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CommercialRequiredFieldsTest extends TestCase
{
    #[DataProvider('requiredFields')]
    public function test_it_requires_each_marked_commercial_field(string $field): void
    {
        $input = $this->validInput();
        unset($input[$field]);

        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has($field));
    }

    public function test_commercial_without_land_does_not_require_land_fields(): void
    {
        $this->assertFalse($this->validator($this->validInput())->fails());
    }

    #[DataProvider('requiredLandFields')]
    public function test_commercial_with_land_requires_house_land_fields(string $field): void
    {
        $input = $this->validInput();
        $input['is_estate_commercial_land'] = 1;
        $input['land_structure_type'] = 1;
        $input['front_with_street'] = 1;
        $input['front_length'] = 12.5;
        unset($input[$field]);

        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has($field));
    }

    public function test_commercial_with_land_accepts_valid_land_fields(): void
    {
        $input = $this->validInput();
        $input['is_estate_commercial_land'] = 1;
        $input['land_structure_type'] = 1;
        $input['front_with_street'] = 1;
        $input['front_length'] = 12.5;

        $this->assertFalse($this->validator($input)->fails());

        $input['front_length'] = -1;
        $this->assertTrue($this->validator($input)->errors()->has('front_length'));
    }

    public function test_separate_building_does_not_require_hidden_unit_number(): void
    {
        $input = $this->validInput();
        $input['is_separate_building'] = 1;
        unset($input['address_apartment']);

        $this->assertFalse($this->validator($input)->fails());
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

    public static function requiredFields(): array
    {
        return [
            ['contract_type'],
            ['estate_status'],
            ['seller'],
            ['location_province'],
            ['location_city'],
            ['location_street'],
            ['address_building'],
            ['address_apartment'],
            ['room_count'],
            ['area_total'],
            ['price_amd'],
            ['refund_percentage'],
            ['commercial_purpose_type'],
            ['building_structure_type'],
            ['building_type'],
            ['building_floor_type'],
            ['exterior_design_type'],
            ['courtyard_improvement'],
            ['distance_public_objects'],
            ['year'],
            ['parking_type'],
            ['windows_view'],
            ['building_window_count'],
            ['repairing_type'],
            ['separate_entrance_type'],
            ['vitrage_type'],
        ];
    }

    public static function requiredLandFields(): array
    {
        return [
            ['land_structure_type'],
            ['front_with_street'],
            ['front_length'],
        ];
    }

    private function validator(array $input)
    {
        $request = CommercialRequest::create('/', 'POST', $input);

        return Validator::make($input, $request->rules());
    }

    private function validInput(): array
    {
        return [
            'estate_type_id' => 3,
            'contract_type' => 1,
            'estate_status' => 1,
            'seller' => 1,
            'location_province' => 2,
            'location_city' => 3,
            'location_street' => 4,
            'address_building' => '15',
            'address_apartment' => '2',
            'is_separate_building' => 0,
            'is_estate_commercial_land' => 0,
            'room_count' => 4,
            'area_total' => 200,
            'price_amd' => 80_000_000,
            'refund_percentage' => 2,
            'commercial_purpose_type' => 1,
            'building_structure_type' => 1,
            'building_type' => 1,
            'building_floor_type' => 1,
            'exterior_design_type' => 1,
            'courtyard_improvement' => 1,
            'distance_public_objects' => 1,
            'year' => 1,
            'parking_type' => 1,
            'windows_view' => 1,
            'building_window_count' => 1,
            'repairing_type' => 1,
            'separate_entrance_type' => 1,
            'vitrage_type' => 1,
        ];
    }
}

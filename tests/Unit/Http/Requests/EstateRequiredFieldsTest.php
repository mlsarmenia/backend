<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\EstateRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class EstateRequiredFieldsTest extends TestCase
{
    #[DataProvider('requiredFields')]
    public function test_it_requires_each_marked_apartment_field(string $field): void
    {
        $input = $this->validInput();
        unset($input[$field]);

        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has($field));
    }

    public function test_it_requires_at_least_one_photo(): void
    {
        $input = $this->validInput();
        $input['temporary_photos'] = '[]';
        $input['temporary_photos_main'] = '';

        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('temporary_photos'));
    }

    public function test_it_requires_a_selected_main_photo(): void
    {
        $input = $this->validInput();
        $input['temporary_photos_main'] = '';

        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('temporary_photos'));
    }

    public function test_it_accepts_a_main_photo_that_is_already_saved_on_the_estate(): void
    {
        $input = $this->validInput();
        $input['temporary_photos'] = json_encode([
            'estate/photos/12/front.jpg',
            'estate/photos/12/kitchen.jpg',
        ]);
        $input['temporary_photos_main'] = '12/front.jpg';

        $validator = $this->validator($input);

        $this->assertFalse($validator->fails());
    }

    public function test_yerevan_uses_community_instead_of_city(): void
    {
        $input = $this->validInput();
        $input['location_province'] = 1;
        $input['location_city'] = null;
        $input['location_community'] = 2;

        $validator = $this->validator($input);

        $this->assertFalse($validator->fails());
    }

    public static function requiredFields(): array
    {
        return [
            ['contract_type'],
            ['agent'],
            ['location_province'],
            ['location_city'],
            ['location_street'],
            ['address_building'],
            ['floor'],
            ['building_floor_count'],
            ['ceiling_height_type'],
            ['room_count'],
            ['area_total'],
            ['price_amd'],
            ['refund_percentage'],
            ['building_structure_type'],
            ['building_type'],
            ['building_project_type'],
            ['building_floor_type'],
            ['exterior_design_type'],
            ['courtyard_improvement'],
            ['distance_public_objects'],
            ['elevator_type'],
            ['year'],
            ['parking_type'],
            ['entrance_type'],
            ['entrance_door_position'],
            ['entrance_door_type'],
            ['windows_view'],
            ['building_window_count'],
            ['repairing_type'],
            ['heating_system_type'],
            ['service_fee_type'],
        ];
    }

    private function validator(array $input)
    {
        $request = EstateRequest::create('/', 'POST', $input);

        return Validator::make($input, $request->rules());
    }

    private function validInput(): array
    {
        return [
            'estate_type_id' => 1,
            'contract_type' => 1,
            'estate_status' => 4,
            'agent' => 1,
            'seller' => 1,
            'location_province' => 2,
            'location_city' => 3,
            'location_community' => null,
            'location_street' => 4,
            'address_building' => '15',
            'address_apartment' => '8',
            'floor' => 5,
            'building_floor_count' => 9,
            'ceiling_height_type' => 1,
            'room_count' => 2,
            'area_total' => 78.5,
            'price_amd' => 45_000_000,
            'refund_percentage' => 2,
            'building_structure_type' => 1,
            'building_type' => 1,
            'building_project_type' => 1,
            'building_floor_type' => 1,
            'exterior_design_type' => 1,
            'courtyard_improvement' => 1,
            'distance_public_objects' => 1,
            'elevator_type' => 1,
            'year' => 1,
            'parking_type' => 1,
            'entrance_type' => 1,
            'entrance_door_position' => 1,
            'entrance_door_type' => 1,
            'windows_view' => 1,
            'building_window_count' => 1,
            'repairing_type' => 1,
            'heating_system_type' => 1,
            'service_fee_type' => 1,
            'temporary_photos' => json_encode(['uploads/tmp/front.jpg']),
            'temporary_photos_main' => 'uploads/tmp/front.jpg',
        ];
    }
}

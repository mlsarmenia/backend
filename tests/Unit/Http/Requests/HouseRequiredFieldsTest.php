<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\HouseRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class HouseRequiredFieldsTest extends TestCase
{
    #[DataProvider('requiredFields')]
    public function test_it_requires_each_marked_house_field(string $field): void
    {
        $input = $this->validInput();
        unset($input[$field]);

        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has($field));
    }

    public function test_non_yerevan_does_not_require_community(): void
    {
        $this->assertFalse($this->validator($this->validInput())->fails());
    }

    public function test_yerevan_requires_community_but_not_city(): void
    {
        $input = $this->validInput();
        $input['location_province'] = 1;
        $input['location_community'] = 5;
        unset($input['location_city']);

        $this->assertFalse($this->validator($input)->fails());

        unset($input['location_community']);
        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('location_community'));
    }

    public function test_rental_requires_owner_but_not_seller(): void
    {
        $input = $this->validInput();
        $input['contract_type'] = 2;
        $input['owner'] = 1;
        unset($input['seller']);

        $this->assertFalse($this->validator($input)->fails());

        unset($input['owner']);
        $validator = $this->validator($input);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('owner'));
    }

    public function test_it_requires_a_photo_and_a_selected_main_photo(): void
    {
        $input = $this->validInput();
        $input['temporary_photos'] = '[]';
        $input['temporary_photos_main'] = '';

        $validator = $this->validator($input);
        $this->assertTrue($validator->errors()->has('temporary_photos'));

        $input = $this->validInput();
        $input['temporary_photos_main'] = '';
        $validator = $this->validator($input);
        $this->assertTrue($validator->errors()->has('temporary_photos'));

        $input['temporary_photos_main'] = 'uploads/tmp/other.jpg';
        $validator = $this->validator($input);
        $this->assertTrue($validator->errors()->has('temporary_photos'));
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

    public function test_front_length_accepts_decimal_values_but_not_negative_values(): void
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
            ['address_building'],
            ['room_count'],
            ['area_total'],
            ['area_residential'],
            ['price_amd'],
            ['refund_percentage'],
            ['house_floors_type'],
            ['repairing_type'],
            ['heating_system_type'],
            ['building_structure_type'],
            ['building_type'],
            ['building_floor_type'],
            ['courtyard_improvement'],
            ['year'],
            ['land_structure_type'],
            ['front_with_street'],
            ['front_length'],
        ];
    }

    private function validator(array $input)
    {
        $request = HouseRequest::create('/', 'POST', $input);

        return Validator::make($input, $request->rules());
    }

    private function validInput(): array
    {
        return [
            'estate_type_id' => 2,
            'contract_type' => 1,
            'estate_status' => 1,
            'seller' => 1,
            'location_province' => 2,
            'location_city' => 3,
            'location_street' => 4,
            'address_building' => '15',
            'room_count' => 3,
            'area_total' => 300,
            'area_residential' => 180,
            'price_amd' => 75_000_000,
            'refund_percentage' => 2,
            'house_floors_type' => 1,
            'repairing_type' => 1,
            'heating_system_type' => 1,
            'building_structure_type' => 1,
            'building_type' => 1,
            'building_floor_type' => 1,
            'courtyard_improvement' => 1,
            'year' => 1,
            'land_structure_type' => 1,
            'front_with_street' => 1,
            'front_length' => 12,
            'temporary_photos' => json_encode(['uploads/tmp/front.jpg']),
            'temporary_photos_main' => 'uploads/tmp/front.jpg',
        ];
    }
}

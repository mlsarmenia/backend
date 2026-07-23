<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\CommercialRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\EstateRequest;
use App\Http\Requests\HouseRequest;
use App\Http\Requests\LandRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionMethod;
use Tests\TestCase;

class NumericInputValidationTest extends TestCase
{
    #[DataProvider('estateRequests')]
    public function test_estate_requests_reject_invalid_numeric_values(string $requestClass): void
    {
        $rules = (new $requestClass)->rules();

        $invalidValues = [
            'floor' => -1,
            'building_floor_count' => '2.5',
            'room_count' => 'three',
            'room_count_modified' => -1,
            'area_total' => 'large',
            'area_residential' => -0.5,
            'price_amd' => 'expensive',
            'price_amd_initial' => -1,
            'price_amd_selled' => 'sold',
        ];

        foreach ($invalidValues as $attribute => $value) {
            $validator = Validator::make(
                [$attribute => $value],
                [$attribute => $rules[$attribute]]
            );

            $this->assertTrue(
                $validator->fails(),
                "{$requestClass} should reject {$attribute}={$value}."
            );
        }
    }

    #[DataProvider('estateRequests')]
    public function test_estate_requests_accept_nullable_and_comma_formatted_prices(string $requestClass): void
    {
        $request = $requestClass::create('/', 'POST', [
            'area_total' => null,
            'price_amd' => '1,234,000',
        ]);

        $method = new ReflectionMethod($request, 'prepareForValidation');
        $method->invoke($request);

        $rules = $request->rules();
        $validator = Validator::make(
            $request->only(['area_total', 'price_amd']),
            [
                'area_total' => $rules['area_total'],
                'price_amd' => $rules['price_amd'],
            ]
        );

        $this->assertSame('1234000', $request->input('price_amd'));
        $this->assertFalse($validator->fails());
    }

    public function test_contact_request_validates_client_numeric_ranges(): void
    {
        $request = new ContactRequest;
        $rules = array_filter(
            $request->rules(),
            fn (string $attribute): bool => str_starts_with($attribute, 'client.'),
            ARRAY_FILTER_USE_KEY
        );
        $rules['client.*.currency_id'] = array_values(array_filter(
            $rules['client.*.currency_id'],
            fn (string $rule): bool => ! str_starts_with($rule, 'exists:')
        ));

        $invalid = Validator::make([
            'client' => [[
                'price_from' => 'cheap',
                'price_to' => -1,
                'area_from' => 'large',
                'area_to' => -0.5,
                'room_count_from' => '1.5',
                'room_count_to' => -1,
            ]],
        ], $rules);

        $this->assertTrue($invalid->fails());
        $this->assertSame([
            'client.0.price_from',
            'client.0.price_to',
            'client.0.area_from',
            'client.0.area_to',
            'client.0.room_count_from',
            'client.0.room_count_to',
            'client.0.currency_id',
        ], $invalid->errors()->keys());

        $valid = Validator::make([
            'client' => [[
                'currency_id' => 1,
                'price_from' => 100000,
                'price_to' => 200000.50,
                'area_from' => 40.5,
                'area_to' => 90,
                'room_count_from' => 1,
                'room_count_to' => 3,
            ]],
        ], $rules);

        $this->assertFalse($valid->fails());
    }

    public static function estateRequests(): array
    {
        return [
            'estate' => [EstateRequest::class],
            'house' => [HouseRequest::class],
            'land' => [LandRequest::class],
            'commercial' => [CommercialRequest::class],
        ];
    }
}

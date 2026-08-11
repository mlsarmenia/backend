<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PhoneNumberValidationTest extends TestCase
{
    private const CONTACT_PHONE_FIELDS = [
        'phone_mobile_1',
        'phone_mobile_2',
        'phone_mobile_3',
        'phone_mobile_4',
        'phone_office',
        'phone_home',
        'fax',
        'viber',
        'whatsapp',
    ];

    #[DataProvider('invalidPhoneNumbers')]
    public function test_contact_phone_fields_reject_non_digit_characters(string $value): void
    {
        $rules = (new ContactRequest)->rules();

        foreach (self::CONTACT_PHONE_FIELDS as $field) {
            $validator = Validator::make(
                [$field => $value],
                [$field => $rules[$field]],
            );

            $this->assertTrue($validator->fails(), "{$field} should reject {$value}.");
        }
    }

    #[DataProvider('validPhoneNumbers')]
    public function test_contact_phone_fields_accept_digits_and_internal_country_prefix(string $value): void
    {
        $rules = (new ContactRequest)->rules();

        foreach (self::CONTACT_PHONE_FIELDS as $field) {
            $validator = Validator::make(
                [$field => $value],
                [$field => $rules[$field]],
            );

            $this->assertFalse($validator->fails(), "{$field} should accept {$value}.");
        }
    }

    #[DataProvider('invalidPhoneNumbers')]
    public function test_message_sender_phone_rejects_non_digit_characters(string $value): void
    {
        $rules = (new MessageRequest)->rules();
        $validator = Validator::make(['sender_phone' => $value], ['sender_phone' => $rules['sender_phone']]);

        $this->assertTrue($validator->fails());
    }

    public function test_optional_phone_fields_accept_empty_values(): void
    {
        $contactRules = (new ContactRequest)->rules();
        $messageRules = (new MessageRequest)->rules();

        foreach (array_slice(self::CONTACT_PHONE_FIELDS, 1) as $field) {
            $validator = Validator::make([$field => null], [$field => $contactRules[$field]]);
            $this->assertFalse($validator->fails(), "{$field} should be nullable.");
        }

        $validator = Validator::make(['sender_phone' => null], ['sender_phone' => $messageRules['sender_phone']]);
        $this->assertFalse($validator->fails());
    }

    public function test_phone_field_uses_numeric_input_and_sanitizes_browser_input(): void
    {
        $field = file_get_contents(resource_path('views/vendor/backpack/crud/fields/phone.blade.php'));

        $this->assertStringContainsString('inputmode="numeric"', $field);
        $this->assertStringContainsString('pattern="[0-9]*"', $field);
        $this->assertStringContainsString("input.addEventListener('beforeinput'", $field);
        $this->assertStringContainsString("input.addEventListener('paste'", $field);
        $this->assertStringContainsString("value.replace(/[^0-9]/g, '')", $field);
    }

    public static function invalidPhoneNumbers(): array
    {
        return [
            'letters' => ['09112abc3'],
            'spaces' => ['091 123 456'],
            'dashes' => ['091-123-456'],
            'parentheses' => ['(091)123456'],
            'multiple plus signs' => ['++37491123456'],
            'embedded plus sign' => ['374+91123456'],
        ];
    }

    public static function validPhoneNumbers(): array
    {
        return [
            'local digits' => ['091123456'],
            'international digits' => ['37491123456'],
            'plugin country prefix' => ['+37491123456'],
        ];
    }
}

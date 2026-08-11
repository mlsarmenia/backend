<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_arm' => 'required',
            'last_name_arm' => 'required',
            'phone_mobile_1' => ['required', 'min:5', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'phone_mobile_2' => ['nullable', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'phone_mobile_3' => ['nullable', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'phone_mobile_4' => ['nullable', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'phone_office' => ['nullable', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'phone_home' => ['nullable', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'fax' => ['nullable', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'viber' => ['nullable', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'whatsapp' => ['nullable', 'max:40', 'regex:/^\+?[0-9]+$/'],
            'client.*.price_from' => ['nullable', 'numeric', 'min:0'],
            'client.*.price_to' => ['nullable', 'numeric', 'min:0'],
            'client.*.area_from' => ['nullable', 'numeric', 'min:0'],
            'client.*.area_to' => ['nullable', 'numeric', 'min:0'],
            'client.*.room_count_from' => ['nullable', 'integer', 'min:0'],
            'client.*.room_count_to' => ['nullable', 'integer', 'min:0'],
            'client.*.currency_id' => [
                'nullable',
                'required_with:client.*.price_from,client.*.price_to',
                'integer',
                'exists:c_currency,id',
            ],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $message = 'Հեռախոսահամարը կարող է պարունակել միայն թվեր։';

        return collect([
            'phone_mobile_1',
            'phone_mobile_2',
            'phone_mobile_3',
            'phone_mobile_4',
            'phone_office',
            'phone_home',
            'fax',
            'viber',
            'whatsapp',
        ])->mapWithKeys(fn (string $field): array => ["{$field}.regex" => $message])->all();
    }
}

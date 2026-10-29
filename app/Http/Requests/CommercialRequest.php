<?php

namespace App\Http\Requests;

use App\Enum\ContractType;
use App\Http\Requests\Concerns\ValidatesEstateNumericFields;
use Illuminate\Foundation\Http\FormRequest;

class CommercialRequest extends FormRequest
{
    use ValidatesEstateNumericFields;

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
        return $this->withEstateNumericRules([
            'contract_type' => 'required',
            'estate_status' => 'required',
            'seller' => 'required_if:contract_type,' . ContractType::SALE->value,
            'owner' => [
                'required_if:contract_type,' . ContractType::RENT->value,
                'required_if:contract_type,' . ContractType::DAILY_RENT->value,
            ],
            'location_province' => 'required',
            'location_city' => 'required_unless:location_province,1',
            'location_community' => 'required_if:location_province,1',
            'location_street' => 'required',
            'address_building' => 'required',
            'address_apartment' => 'required_unless:is_separate_building,1',
            'room_count' => 'required',
            'area_total' => 'required',
            'price_amd' => 'required',
            'refund_percentage' => 'required',
            'commercial_purpose_type' => 'required',
            'building_structure_type' => 'required',
            'building_type' => 'required',
            'building_floor_type' => 'required',
            'exterior_design_type' => 'required',
            'courtyard_improvement' => 'required',
            'distance_public_objects' => 'required',
            'year' => 'required',
            'parking_type' => 'required',
            'windows_view' => 'required',
            'building_window_count' => 'required',
            'repairing_type' => 'required',
            'separate_entrance_type' => 'required',
            'vitrage_type' => 'required',
            'land_structure_type' => 'required_if:is_estate_commercial_land,1',
            'front_with_street' => 'required_if:is_estate_commercial_land,1',
            'front_length' => ['required_if:is_estate_commercial_land,1', 'numeric', 'min:0'],
        ]);
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
        return [
            'required_if' => 'Պարտադիր է լրացման համար։',
            'required_unless' => 'Պարտադիր է լրացման համար։',
            'archive_till_date.required_if' => 'Արխիվացված կարգավիճակում անհրաժեշտ է լրացնել։',
            'archive_comment_arm.required_if' => 'Արխիվացված կարգավիճակում անհրաժեշտ է լրացնել։',
        ];
    }
}

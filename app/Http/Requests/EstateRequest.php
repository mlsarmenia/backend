<?php

namespace App\Http\Requests;

use App\Enum\ContractType;
use App\Http\Requests\Concerns\ValidatesEstateNumericFields;
use Illuminate\Foundation\Http\FormRequest;

class EstateRequest extends FormRequest
{
    use ValidatesEstateNumericFields;

    private const REQUIRED_APARTMENT_BUILDING_FIELDS = [
        'building_structure_type',
        'building_type',
        'building_project_type',
        'building_floor_type',
        'exterior_design_type',
        'courtyard_improvement',
        'distance_public_objects',
        'elevator_type',
        'year',
        'parking_type',
        'entrance_type',
        'entrance_door_position',
        'entrance_door_type',
        'windows_view',
        'building_window_count',
        'repairing_type',
        'heating_system_type',
        'service_fee_type',
    ];

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
        $rules = [
            'contract_type' => 'required',
            'estate_status' => 'required',
            'agent' => 'required',
            'seller' => 'required_if:contract_type,1',
            'owner' => [
                'required_if:contract_type,' . ContractType::RENT->value,
                'required_if:contract_type,' . ContractType::DAILY_RENT->value,
            ],
            'location_province' => 'required',
            'location_city' => 'required',
            'location_community' => 'required',
            'location_street' => 'required',
            'address_building' => 'required',
            'address_apartment' => [
                function ($attribute, $value, $fail) {
                    $estateStatus = (int) $this->input('estate_status');
                    $estateType = (int) $this->input('estate_type_id');

                    if (($estateStatus === 4) && ($estateType === 1) && empty($value)) {
                        $fail($attribute . ' is required.');
                    }
                },
            ],
            'floor' => 'required',
            'building_floor_count' => 'required',
            'ceiling_height_type' => 'required',
            'room_count' => 'required',
            'area_total' => 'required',
            'price_amd' => 'required',
            'refund_percentage' => 'required',
            'temporary_photos' => ['required', $this->requiresPhotosAndMainSelection()],
            'archive_till_date' => 'required_if:estate_status,8',
            'archive_comment_arm' => 'required_if:estate_status,8',
        ];

        foreach (self::REQUIRED_APARTMENT_BUILDING_FIELDS as $field) {
            $rules[$field] = 'required';
        }

        return $this->withEstateNumericRules($rules);
    }

    private function requiresPhotosAndMainSelection(): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail): void {
            $photos = $this->photoPaths($value);

            if ($photos === []) {
                $fail('Առնվազն մեկ նկար պետք է վերբեռնված լինի։');

                return;
            }

            $mainPhoto = $this->input('temporary_photos_main');
            $photoNames = array_map('basename', $photos);

            if (! is_string($mainPhoto)
                || trim($mainPhoto) === ''
                || ! in_array(basename($mainPhoto), $photoNames, true)) {
                $fail('Պետք է ընտրվի գլխավոր նկար։');
            }
        };
    }

    /**
     * @return array<int, string>
     */
    private function photoPaths(mixed $value): array
    {
        $photos = is_string($value) ? json_decode($value, true) : $value;

        if (! is_array($photos)) {
            return [];
        }

        return array_values(array_filter(
            $photos,
            static fn (mixed $photo): bool => is_string($photo) && trim($photo) !== ''
        ));
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

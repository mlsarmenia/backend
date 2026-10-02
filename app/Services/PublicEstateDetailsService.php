<?php

namespace App\Services;

use App\Enum\EstateType;
use App\Models\Estate;

class PublicEstateDetailsService
{
    private const APARTMENT_BUILDING_RELATIONS = [
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

    private const COMMERCIAL_BUILDING_RELATIONS = [
        'commercial_purpose_type',
        'building_structure_type',
        'building_type',
        'building_project_type',
        'building_floor_type',
        'exterior_design_type',
        'courtyard_improvement',
        'distance_public_objects',
        'year',
        'parking_type',
        'entrance_type',
        'entrance_door_type',
        'windows_view',
        'building_window_count',
        'repairing_type',
        'heating_system_type',
    ];

    private const AMENITY_TRANSLATION_KEYS = [
        'new_construction' => 'new_construction',
        'apartment_construction' => 'apartment_construction',
        'exclusive_design' => 'exclusive_design',
        'possible_extension' => 'possible_extension',
        'new_roof' => 'new_roof',
        'separate_room' => 'separate_room',
        'balcony' => 'balcony',
        'oriel' => 'oriel',
        'open_balcony' => 'open_balcony',
        'uninhabited' => 'uninhabited',
        'new_water_tubes' => 'new_water_tubes',
        'new_wiring' => 'new_wiring',
        'new_windows' => 'new_windows',
        'new_doors' => 'new_doors',
        'new_floor' => 'new_floor',
        'laminat' => 'laminat',
        'parquet' => 'parquet',
        'heating_ground' => 'heating_ground',
        'new_bathroom' => 'new_bathroom',
        'jacuzzi' => 'jacuzzi',
        'persistent_water' => 'persistent_water',
        'natural_gas' => 'natural_gas',
        'gas_heater' => 'gas_heater',
        'refrigirator' => 'refrigirator',
        'washer' => 'washer',
        'dish_washer' => 'dish_washer',
        'tv' => 'tv',
        'conditioner' => 'conditioner',
        'cable_tv' => 'cable_tv',
        'internet' => 'internet',
        'kitchen_furniture' => 'kitchen_furniture',
        'furniture' => 'furniture',
        'pantry' => 'pantry',
        'niche' => 'niche',
        'cellar' => 'cellar',
        'garage' => 'garage',
        'land' => 'land',
        'has_intercom' => 'has_intercom',
        'sunny' => 'sunny',
        'is_basement' => 'is_basement',
        'is_duplex' => 'is_duplex',
        'is_mansard_floor' => 'is_mansard_floor',
        'can_be_used_as_commercial' => 'can_be_used_as_commercial',
        'exchange' => 'can_be_exchanged',
    ];

    /** @return array<int, array{label: string, value: string}> */
    public function buildingDetails(Estate $estate): array
    {
        $details = [];

        foreach ($this->buildingRelations($estate) as $relation) {
            if ($estate->getAttribute("{$relation}_id") === null) {
                continue;
            }

            $value = trim((string) $estate->{$relation}?->name_arm);

            if ($value === '') {
                continue;
            }

            $details[] = [
                'label' => $this->label($relation),
                'value' => $value,
            ];
        }

        if ($this->hasApartmentBuildingDetails($estate) && $estate->service_amount !== null) {
            $currency = trim((string) $estate->service_amount_currency?->name_arm);
            $value = number_format((float) $estate->service_amount, 0, '.', ' ');

            $details[] = [
                'label' => $this->label('service_fee_amount'),
                'value' => trim("{$value} {$currency}"),
            ];
        }

        return $details;
    }

    /** @return array<int, string> */
    public function amenities(Estate $estate): array
    {
        if ($estate->estate_type_id === EstateType::LAND->value) {
            return [];
        }

        $amenities = [];

        foreach (self::AMENITY_TRANSLATION_KEYS as $attribute => $translationKey) {
            if (! $estate->getAttribute($attribute)) {
                continue;
            }

            $amenities[] = $this->label($translationKey);
        }

        return $amenities;
    }

    /** @return array<int, string> */
    private function buildingRelations(Estate $estate): array
    {
        return match ($estate->estate_type_id) {
            EstateType::APARTMENT->value,
            EstateType::HOUSE->value => self::APARTMENT_BUILDING_RELATIONS,
            EstateType::COMMERCIAL->value => self::COMMERCIAL_BUILDING_RELATIONS,
            default => [],
        };
    }

    private function hasApartmentBuildingDetails(Estate $estate): bool
    {
        return in_array($estate->estate_type_id, [
            EstateType::APARTMENT->value,
            EstateType::HOUSE->value,
        ], true);
    }

    private function label(string $key): string
    {
        return trim((string) trans("estate.{$key}", [], 'hy'));
    }
}

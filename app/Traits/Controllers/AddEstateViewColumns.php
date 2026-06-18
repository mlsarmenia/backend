<?php

namespace App\Traits\Controllers;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait AddEstateViewColumns
{
    private function addBuildingColumns(): void
    {

        /*Apartment building attribute*/

        $building_attributes = [
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

        $addApartmentBuildingList = [];

        foreach ($building_attributes as $buildingAttribute) {
            $addApartmentBuildingList[] = [
                'name' => $buildingAttribute,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $buildingAttribute),
                'tab' => 'Հիմնական',
                'className' => 'form-group col-md-6 apartment_building_attribute',
            ];
        }

        CRUD::addColumn([
            'name' => 'building',
            'type' => 'custom_html',
            'value' => '<h2 class="text-xl">Շենք</h2> ',
            'show_as_title' => true,
            'tab' => 'Հիմնական',
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumns($addApartmentBuildingList);

        CRUD::addColumn([
            'name' => 'service_amount',
            'type' => "number",
            'label' => "Սպասարկման վճար",
            'tab' => 'Հիմնական',
            'className' => 'form-group col-md-3'
        ]);


    }

    private function addCommercialBuildingColumns(): void
    {

        /*Apartment building attribute*/

        $building_attributes = [
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

        $addCommercialBuildingList = [];

        foreach ($building_attributes as $buildingAttribute) {
            $addCommercialBuildingList[] = [
                'name' => $buildingAttribute,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $buildingAttribute),
                'tab' => 'Հիմնական',
                'className' => 'form-group col-md-6 apartment_building_attribute',
            ];
        }

        CRUD::addColumn([
            'name' => 'building',
            'type' => 'custom_html',
            'value' => '<h2 class="text-xl">Շենք</h2> ',
            'show_as_title' => true,
            'tab' => 'Հիմնական',
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumns($addCommercialBuildingList);


    }
    private function addApartmentFacilitesColumns(): void
    {

        $apartmentFeaturesList = [
            "new_construction",
            "apartment_construction",
            "exclusive_design",
            "possible_extension",
            "new_roof",
            "separate_room",
            "balcony",
            "oriel",
            "open_balcony",
            "uninhabited",
            "new_water_tubes",
            "new_wiring",
            "new_windows",
            "new_doors",
            "new_floor",
            "laminat",
            "parquet",
            "heating_ground",
            "new_bathroom",
            "jacuzzi",
            "persistent_water",
            "natural_gas",
            "gas_heater",
            "refrigirator",
            "washer",
            "dish_washer",
            "tv",
            "conditioner",
            "cable_tv",
            "internet",
            "kitchen_furniture",
            "furniture",
            "pantry",
            "niche",
            "cellar",
            "garage",
            "land",
            "has_intercom",
            "sunny",
            "is_basement",
            "is_duplex",
            "is_mansard_floor",
            "can_be_used_as_commercial",
            "exchange"
        ];
        $addAppartmentFeaturesList = [];


        foreach ($apartmentFeaturesList as $feature) {
            $addAppartmentFeaturesList[] = [
                'name' => $feature,
                'type' => 'check',
                'label' => trans('estate.' . $feature),
                'tab' => 'Հիմնական',
                'className' => 'form-group col-md-3'
            ];
        }
        CRUD::addColumn([
            'name' => 'facilities',
            'type' => 'custom_html',
            'value' => '<h2 class="text-xl">Կոմունալ  հարմարություններ</h2> ',
            'show_as_title' => true,
            'tab' => 'Հիմնական',
            'className' => 'col-md-12 mt-4 pt-4 mb-4 border-solid  border-t-4  '
        ]);

        CRUD::addColumns($addAppartmentFeaturesList);
    }

    private function addLandColumns(): void
    {

        $land_attributes = [
            'land_type',
            'land_use_type',
            'land_structure_type',
            'communication_type',
            'fence_type',
            'road_way_type',
            'front_with_street',
        ];

        $addLandFeaturesList = [];


        foreach ($land_attributes as $feature) {
            $addLandFeaturesList[] = [
                'name' => $feature,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $feature),
                'tab' => 'Հիմնական',
                'className' => 'form-group col-md-6 apartment_building_attribute',
            ];
        }
        CRUD::addColumn([
            'name' => 'landDetails',
            'type' => 'custom_html',
            'value' => '<h2 class="text-xl">Հող</h2> ',
            'show_as_title' => true,
            'tab' => 'Հիմնական',
            'className' => 'col-md-12 mt-4 pt-4 mb-4 border-solid  border-t-4  '
        ]);

        CRUD::addColumns($addLandFeaturesList);
    }
    private function addHouseColumns(): void
    {

        $house_attributes = [
            'house_floors_type',
            'roof_type',
            'roof_material_type',
            'repairing_type',
            'heating_system_type'
        ];

        $addHouseList = [];


        foreach ($house_attributes as $feature) {
            $addHouseList[] = [
                'name' => $feature,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $feature),
                'placeholder' => '-Ընտրել մեկը-',
                'tab' => 'Հիմնական',
                'className' => 'form-group col-md-6 apartment_building_attribute',
            ];
        }
        CRUD::addColumn([
            'name' => 'houseDetails',
            'type' => 'custom_html',
            'value' => '<h2 class="text-xl">Առանձնատուն</h2> ',
            'show_as_title' => true,
            'tab' => 'Հիմնական',
            'className' => 'col-md-12 mt-4 pt-4 mb-4 border-solid  border-t-4  '
        ]);

        CRUD::addColumns($addHouseList);
    }

}

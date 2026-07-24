<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Operations\RedDropZoneOperation;
use App\Http\Requests\EstateRequest;
use App\Models\CLocationCity;
use App\Models\CLocationCommunity;
use App\Models\CLocationStreet;
use App\Models\Contact;
use App\Models\Estate;
use App\Models\RealtorUser;
use App\Traits\Controllers\AddEstateCreateCommonFields;
use App\Traits\Controllers\AddEstateFetchMethods;
use App\Traits\Controllers\AddEstateListColumns;
use App\Traits\Controllers\HasEstateFilters;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Backpack\Pro\Http\Controllers\Operations\FetchOperation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class EstateCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TownhouseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use RedDropZoneOperation;
    use FetchOperation;
    use AuthorizesRequests;
    use HasEstateFilters;
    use AddEstateCreateCommonFields;
    use AddEstateListColumns;
    use AddEstateFetchMethods;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Estate::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/house');
//        CRUD::setEntityNameStrings('գույք', 'Անշարժ գույք');
        CRUD::setEntityNameStrings('estate', 'Անշարժ գույք');
    }

    protected function setupShowOperation()
    {
        $this->authorize('create', Estate::class);
        CRUD::setShowView('redg.estate.show');
        Widget::add()->type('script')
            ->content('https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js')
            ->crossorigin('anonymous');
        $estate = $this->crud->getCurrentEntry();

        $this->crud->data['estate'] = $estate;


    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        Widget::add()->type('script')->content('assets/js/admin/lists/estate.js');
        $this->crud->addButton('top', 'estate_create_buttons_set', 'view', 'crud::buttons.estate_create_buttons_set');
        $this->crud->removeButton('create');
        $this->crud->addButton('line', 'archive', 'view', 'crud::buttons.archive');
        $this->crud->addButton('line', 'photo', 'view', 'crud::buttons.photo');
        $this->crud->addButton('line', 'message', 'view', 'crud::buttons.message');
        $this->crud->addButton('line', 'star', 'view', 'crud::buttons.star');

        /*Columns*/
        $this->addListColumns();

        /*Filters*/
        $this->addListFilters();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
//        $this->authorize('create', Estate::class);
        CRUD::setValidation(EstateRequest::class);
        Widget::add()->type('script')->content('assets/js/admin/forms/estate.js');

        $this->addHouseFields();

        CRUD::addField([
            'name' => 'separator12',
            'type' => 'custom_html',
            'value' => '<h4>Առանձնատուն</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);
        $house_attributes = [
            'house_floors_type',
            'roof_type',
            'roof_material_type',
            'repairing_type',
            'heating_system_type'
        ];

        foreach ($house_attributes as $houseAttribute) {
            $addHouseList[] = [
                'name' => $houseAttribute,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $houseAttribute),
                'placeholder' => '-Ընտրել մեկը-',
                'tab' => 'Հիմնական',
                'wrapper' => [
                    'class' => 'form-group col-md-3 apartment_building_attribute'
                ],
            ];
        }

        CRUD::addFields($addHouseList);


        CRUD::addField([
            'name' => 'separator_building_house',
            'type' => 'custom_html',
            'value' => '<h4>Շենք</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);
        $building_attributes = [
            'building_structure_type',
            'building_type',
            'building_floor_type',
            'exterior_design_type',
            'courtyard_improvement',
            'distance_public_objects',
            'year',
            'parking_type',
        ];

        foreach ($building_attributes as $buidlingAttribute) {
            $addBuildingList[] = [
                'name' => $buidlingAttribute,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $buidlingAttribute),
                'placeholder' => '-Ընտրել մեկը-',
                'tab' => 'Հիմնական',
                'wrapper' => [
                    'class' => 'form-group col-md-3 apartment_building_attribute'
                ],
            ];
        }

        CRUD::addFields($addBuildingList);


        CRUD::addField([
            'name' => 'separator_building_land',
            'type' => 'custom_html',
            'value' => '<h4>Հող</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);
        $land_attributes = [
            'land_structure_type',
            'communication_type',
            'fence_type',
            'road_way_type',
            'front_with_street',
        ];

        foreach ($land_attributes as $landAttribute) {
            $addLandList[] = [
                'name' => $landAttribute,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $landAttribute),
                'placeholder' => '-Ընտրել մեկը-',
                'tab' => 'Հիմնական',
                'wrapper' => [
                    'class' => 'form-group col-md-3 apartment_building_attribute'
                ],
            ];
        }

        CRUD::addFields($addLandList);

        CRUD::addField([
            'name' => 'front_length',
            'type' => "number",
            'label' => "Ճակատային դիրքի երկարություն",
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-3 apartment_building_attribute'
            ],
        ]);


        $apartmentFeaturesList = [
            "new_construction",
            "apartment_construction",
            "exclusive_design",
            "new_roof",
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
            "has_intercom",
            "sunny",
            "can_be_used_as_commercial",
            "exchange"
        ];
        $addAppartmentFeaturesList = [];


        foreach ($apartmentFeaturesList as $feature) {
            $addAppartmentFeaturesList[] = [
                'name' => $feature,
                'type' => 'switch',
                'label' => trans('estate.' . $feature),
                'tab' => 'Հիմնական',
                'wrapper' => [
                    'class' => 'form-group col-md-3'
                ],
            ];
        }


        CRUD::addField([
            'name' => 'separator1',
            'type' => 'custom_html',
            'value' => '<hr>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);
        CRUD::addField([
            'name' => 'separator',
            'type' => 'custom_html',
            'value' => '<h4>Կոմունալ հարմարություններ</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);


        CRUD::addFields($addAppartmentFeaturesList);


        $this->addCreateCommonFields(5);

        $this->addCreateTranslationFields();;


    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $estate = $this->crud->getCurrentEntry();
        CRUD::setOperationSetting('strippedRequest', function ($request) {
            $input = $request->all();
            return $input;
        });

        CRUD::removeField('estate_type');
        if (!empty($estate->estate_longitude) && !empty($estate->estate_latitude)) {
            CRUD::removeField('location');

            CRUD::addField([
                'name' => 'location',
                'label' => 'Տեղը քարտեզի վրա',
                'type' => 'google_map',
                'tab' => 'Քարտեզ',
                'value' => '{"lat":' . $estate->estate_latitude . ',"lng":' . $estate->estate_longitude . '}',

                'map_options' => [
                    'default_lat' => $estate->estate_latitude,
                    'default_lng' => $estate->estate_longitude,
                    'locate' => true,
                    'height' => 400,
                ]
            ]);
        }

    }

    public function fetchLocationStreet()
    {
        return $this->fetch([
            'model' => CLocationStreet::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $params = collect(request()->input('form'))->pluck('value', 'name');
                $cityId = $params['location_city'];
                $communityId = $params['location_community'];
                $search = request()->input('q') ?? false;
                if ($search && $communityId) {
                    return $model->where('parent_is_community', true)->where('community_id', '=', $communityId)->whereRaw('CONCAT_WS(" ", `name_eng`, `name_arm`) LIKE ?', ['%' . $search . '%']);
                } elseif ($search && $cityId) {
                    return $model->where('parent_is_community', false)->where('parent_id', '=', $cityId)->whereRaw('CONCAT_WS(" ", `name_eng`, `name_arm`) LIKE ?', ['%' . $search . '%']);
                } elseif ($communityId) {
                    return $model->where('parent_is_community', true)->where('community_id', '=', $communityId);
                } elseif ($cityId) {
                    return $model->where('parent_is_community', false)->where('parent_id', '=', $cityId);
                } else {
                    return $model->where('id', '<', 0);
                }
            }
        ]);
    }


    private function addCreateCommonFields($estateType): void
    {

        /*Basic fields*/

        CRUD::addField([
            'name' => 'estate_type_id',
            'type' => 'number',
            'label' => "Գույքի տեսակ",
            'default' => $estateType,
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-3 d-none'
            ],
        ]);

        CRUD::addField([
            'name' => 'contract_type',
            'type' => "relationship",
            'attribute' => "name_arm",
            'label' => "Կոնտրակտի տեսակ",
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        CRUD::addField([
            'name' => 'seller',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "fullContact",
            'placeholder' => '-Ընտրել մեկը-',
            'ajax' => true,
            'minimum_input_length' => 0,
            'label' => "Վաճառող",
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'location_province',
            'type' => "relationship",
            'attribute' => "name_arm",
            'label' => "Մարզ",
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-3 '
            ],
        ]);

        CRUD::addField([
            'name' => 'location_city',
            'type' => "relationship",
            'attribute' => "name_arm",
            'ajax' => true,
            'minimum_input_length' => 0,
            'include_all_form_fields' => true,
            'label' => "Քաղաք",
            'dependencies' => ['location_province'],
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-3 '
            ],
        ]);

        CRUD::addField([
            'name' => 'location_community',
            'type' => "relationship",
            'attribute' => "name_arm",
            'ajax' => true,
            'minimum_input_length' => 0,
            'dependencies' => ['location_province'],
            'label' => "Համայնք",
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'name' => 'location_street',
            'type' => "relationship",
            'attribute' => "name_arm",
            'ajax' => true,
            'minimum_input_length' => 0,
            'dependencies' => ['location_province'],
            'label' => "Փողոց",
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);


        CRUD::addField([
            'name' => 'address_building',
            'type' => "text",
            'label' => "Շենք",
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);


        CRUD::addField([
            'name' => 'address_apartment',
            'type' => "text",
            'label' => "Վկայական",
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'name' => 'rooms_separator',
            'type' => 'custom_html',
            'value' => '<br/>',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);


        CRUD::addField([
            'name' => 'room_count',
            'type' => "number",
            'label' => "Սենյակներ",
            'wrapper' => [
                'class' => 'form-group col-md-2'
            ],
        ]);


        CRUD::addField([
            'name' => 'room_count_modified',
            'type' => "number",
            'label' => "Սենյակներ (mod)",
            'wrapper' => [
                'class' => 'form-group col-md-2'
            ],
        ]);


        CRUD::addField([
            'name' => 'area_total',
            'type' => "number",
            'label' => "Հողամասի մակերես",
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);


        CRUD::addField([
            'name' => 'area_residential',
            'type' => "number",
            'label' => "Շինության մակերես",
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);


        CRUD::addField([
            'name' => 'separator123',
            'type' => 'custom_html',
            'value' => '<br/>',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);


        CRUD::addField([
            'name' => 'price_amd',
            'type' => "text",
            'label' => "Գին",
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            "suffix" => 'AMD'
        ]);


        /*Նկարներ tab fields*/

        $this->addCreateDropzoneField();

        /*Քարտեզ tab fields*/

        $this->addCreateMapField();

        /*Մասնագիտական tab fields*/

        $this->addCreateProfessionalFields();

        /*Լրացուցիչ tab fields*/

        $this->addCreateAdditionalFields();

    }

    private function addHouseFields(): void
    {

        CRUD::addField([
            'name' => 'separator12',
            'type' => 'custom_html',
            'value' => '<h4>Առանձնատուն</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);
        $house_attributes = [
            'house_floors_type',
            'roof_type',
            'roof_material_type',
            'repairing_type',
            'heating_system_type'
        ];

        foreach ($house_attributes as $houseAttribute) {
            $addHouseList[] = [
                'name' => $houseAttribute,
                'entity' => $houseAttribute,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $houseAttribute),
                'placeholder' => '-Ընտրել մեկը-',
                'tab' => 'Հիմնական',
                'wrapper' => [
                    'class' => 'form-group col-md-3 apartment_building_attribute'
                ],
            ];
        }

        CRUD::addFields($addHouseList);


        CRUD::addField([
            'name' => 'separator_building_house',
            'type' => 'custom_html',
            'value' => '<h4>Շենք</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);
        $building_attributes = [
            'building_structure_type',
            'building_type',
            'building_floor_type',
            'exterior_design_type',
            'courtyard_improvement',
            'distance_public_objects',
            'year',
            'parking_type',
        ];

        foreach ($building_attributes as $buidlingAttribute) {
            $addBuildingList[] = [
                'name' => $buidlingAttribute,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $buidlingAttribute),
                'placeholder' => '-Ընտրել մեկը-',
                'tab' => 'Հիմնական',
                'wrapper' => [
                    'class' => 'form-group col-md-3 apartment_building_attribute'
                ],
            ];
        }

        CRUD::addFields($addBuildingList);


        CRUD::addField([
            'name' => 'separator_building_land',
            'type' => 'custom_html',
            'value' => '<h4>Հող</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);
        $land_attributes = [
            'land_structure_type',
            'communication_type',
            'fence_type',
            'road_way_type',
            'front_with_street',
        ];

        foreach ($land_attributes as $landAttribute) {
            $addLandList[] = [
                'name' => $landAttribute,
                'type' => 'relationship',
                'attribute' => "name_arm",
                'label' => trans('estate.' . $landAttribute),
                'placeholder' => '-Ընտրել մեկը-',
                'tab' => 'Հիմնական',
                'wrapper' => [
                    'class' => 'form-group col-md-3 apartment_building_attribute'
                ],
            ];
        }

        CRUD::addFields($addLandList);

        CRUD::addField([
            'name' => 'front_length',
            'type' => "number",
            'label' => "Ճակատային դիրքի երկարություն",
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-3 apartment_building_attribute'
            ],
        ]);


        $apartmentFeaturesList = [
            "new_construction",
            "apartment_construction",
            "exclusive_design",
            "new_roof",
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
            "has_intercom",
            "sunny",
            "can_be_used_as_commercial",
            "exchange"
        ];
        $addAppartmentFeaturesList = [];


        foreach ($apartmentFeaturesList as $feature) {
            $addAppartmentFeaturesList[] = [
                'name' => $feature,
                'type' => 'switch',
                'label' => trans('estate.' . $feature),
                'tab' => 'Հիմնական',
                'wrapper' => [
                    'class' => 'form-group col-md-3'
                ],
            ];
        }


        CRUD::addField([
            'name' => 'separator1',
            'type' => 'custom_html',
            'value' => '<hr>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);
        CRUD::addField([
            'name' => 'separator',
            'type' => 'custom_html',
            'value' => '<h4>Կոմունալ հարմարություններ</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);


        CRUD::addFields($addAppartmentFeaturesList);

    }


}

<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Operations\DownloadEstateImagesOperation;
use App\Http\Controllers\Admin\Operations\EntryActivityOperation;
use App\Http\Controllers\Admin\Operations\RedDropZoneOperation;
use App\Http\Requests\EstateRequest;
use App\Http\Requests\LandRequest;
use App\Models\CLocationCity;
use App\Models\CLocationCommunity;
use App\Models\CLocationStreet;
use App\Models\Contact;
use App\Models\Estate;
use App\Models\RealtorUser;
use App\Traits\Controllers\AddDefaultSaveActions;
use App\Traits\Controllers\AddEstateCreateCommonFields;
use App\Traits\Controllers\AddEstateFetchMethods;
use App\Traits\Controllers\AddEstateListColumns;
use App\Traits\Controllers\AddLandCreateCommonFields;
use App\Traits\Controllers\CloneEstate;
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
class LandCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use EntryActivityOperation;
    use RedDropZoneOperation;
    use FetchOperation;
    use AuthorizesRequests;
    use HasEstateFilters;
    use AddLandCreateCommonFields;
    use AddEstateListColumns;
    use AddEstateFetchMethods;
    use DownloadEstateImagesOperation;
    use AddDefaultSaveActions;
    use CloneEstate;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Estate::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/land');
        CRUD::setEntityNameStrings('estate', 'Հող');
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
        CRUD::setValidation(LandRequest::class);
        Widget::add()->type('script')->content('assets/js/admin/forms/estate.js');


        $this->addLandFields();

        CRUD::addField([
            'name' => 'public_text_en',
            'type' => "textarea",
            'attributes' => [
                'rows' => 7,
            ],
            'label' => "Հայտարարության տեքստ (ENG)",
            'tab' => 'Թարգմանություն',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'public_text_ru',
            'type' => "textarea",
            'attributes' => [
                'rows' => 7,
            ],
            'label' => "Հայտարարության տեքստ (RU)",
            'tab' => 'Թարգմանություն',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);


        CRUD::addField([
            'name' => 'separator77776788',
            'type' => 'custom_html',
            'value' => '<h4>SEO</h4>',
            'tab' => 'Թարգմանություն',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);

        CRUD::addField([
            'name' => 'meta_title_en',
            'type' => "textarea",
            'label' => "Վերնագիր SEO ENG",
            'tab' => 'Թարգմանություն',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'meta_description_en',
            'type' => "textarea",
            'label' => "Նկարագրություն SEO ENG",
            'tab' => 'Թարգմանություն',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'meta_title_ru',
            'type' => "textarea",
            'label' => "Վերնագիր SEO RU",
            'tab' => 'Թարգմանություն',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'meta_description_ru',
            'type' => "textarea",
            'label' => "Նկարագրություն SEO RU",
            'tab' => 'Թարգմանություն',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        $estate = $this->crud->getCurrentEntry();
        if ($estate && in_array($estate->contract_type_id, [2, 3])) {

            CRUD::addField([
                'name'          => 'rentContracts',
                'label'          => 'Վարձակալություն',
                'attribute'          => 'id',
                'type'          => "renting_table",
                'new_item_label'  => 'Նոր Վարձակալություն',
                'subfields'   => [
                    [
                        'name' => 'initial_price',
                        'label' => 'Նախնական գին',
                        'type' => 'text',
                        'wrapper' => [
                            'class' => 'form-group col-md-2',
                        ],
                    ],
                    [
                        'name' => 'final_price',
                        'label' => 'Վերջնական գին',
                        'type' => 'text',
                        'wrapper' => [
                            'class' => 'form-group col-md-2',
                        ],
                    ],
                    [
                        'label' => 'Սկիզբ',
                        'type' => 'date',
                        'name' => 'start_date',
                        'wrapper' => [
                            'class' => 'form-group col-md-2',
                        ],
                    ],
                    [
                        'label' => 'Ավարտ',
                        'type' => 'date',
                        'name' => 'end_date',
                        'wrapper' => [
                            'class' => 'form-group col-md-2',
                        ],
                    ],
                    [
                        'label' => 'Վարձակալ',
                        'type' => 'relationship',
                        'ajax' => true,
                        'inline_create' => true,
                        'attribute' => 'fullContact',
                        'minimum_input_length' => 0,
                        'name' => 'renter',
                        'wrapper' => [
                            'class' => 'form-group col-md-2',
                        ],
                    ],
                    [
                        'label' => 'Գործակալ',
                        'type' => 'relationship',
                        'ajax' => true,
                        'attribute' => 'contactFullName',
                        'minimum_input_length' => 0,
                        'name' => 'agent',
                        'wrapper' => [
                            'class' => 'form-group col-md-2',
                        ],
                    ],
                    [
                        'label' => 'Մեկնաբանություն',
                        'name' => 'comment_arm',
                        'wrapper' => [
                            'class' => 'form-group col-md-12',
                        ],
                    ],
                ],
                'tab' => 'Վարձակալություն',
            ]);

        }

        $this->addCreateCommonFields(4);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $estate = $this->crud->getCurrentEntry();
        CRUD::setOperationSetting('strippedRequest', function ($request) {
            $input = $request->all();
            return $input;
        });
        $estateType = request()->estateType;
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

    private function addLandFields(): void
    {


        CRUD::addField([
            'name' => 'separator_building_land',
            'type' => 'custom_html',
            'value' => '<h4>Հող</h4>',
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator mt-4 mb-4'
            ],
        ]);
        $land_attributes = [
            'land_type',
            'land_use_type',
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
                    'class' => 'form-group col-md-4 apartment_building_attribute'
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

        CRUD::addField([
            'name' => 'separator',
            'type' => 'custom_html',
            'value' => '<br/>',
            'tab' => 'Հիմնական',
        ]);

        CRUD::addField([
            'name' => 'arch_project_package',
            'label' => 'ՃՇՆ փաթեթ',
            'type' => 'select_from_array',
            'options' => [0 => 'Առկա չէ', 1 => 'Առկա է'],
            'default' => 0,
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-4 apartment_building_attribute',
            ],
        ]);

        CRUD::addField([
            'name' => 'arch_project',
            'label' => 'Հաստատված ՃՇՆ',
            'type' => 'select_from_array',
            'options' => [0 => 'Առկա չէ', 1 => 'Առկա է'],
            'default' => 0,
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-4 apartment_building_attribute',
            ],
        ]);

        CRUD::addField([
            'name' => 'building_permit',
            'label' => 'Շին․ թույլտվություն',
            'type' => 'select_from_array',
            'options' => [0 => 'Առկա չէ', 1 => 'Առկա է'],
            'default' => 0,
            'tab' => 'Հիմնական',
            'wrapper' => [
                'class' => 'form-group col-md-4 apartment_building_attribute'
            ],
        ]);
    }

}

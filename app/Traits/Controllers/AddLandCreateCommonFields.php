<?php

namespace App\Traits\Controllers;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

trait AddLandCreateCommonFields
{
    private function addCreateCommonFields($estateType): void
    {

        Widget::add()->type('script')
            ->content('https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js')
            ->crossorigin('anonymous');

        /*Basic fields*/

        $this->addCreateBasicFields($estateType);

        /*Նկարներ tab fields*/

        $this->addCreateDropzoneField();

        /*Քարտեզ tab fields*/

        $this->addCreateMapField();

        /*Մասնագիտական tab fields*/

        $this->addCreateProfessionalFields();

        /*Լրացուցիչ tab fields*/

        $this->addCreateAdditionalFields();

        /*Translations*/

        $this->addCreateTranslationFields();

    }

    private function addCreateBasicFields($estateType) {
        /*Basic fields*/

        CRUD::addField([
            'name' => 'code',
            'type' => 'text',
            'attribute' => "code",
            'label' => "Գույքի կոդ",
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'wrapper' => [
                'class' => 'form-group col-md-2'
            ],
        ]);

        CRUD::addField([
            'name' => 'estate_type_id',
            'type' => 'number',
            'attribute' => "name_arm",
            'label' => "Գույքի տեսակ",
            'default' => $estateType,
            'attributes' => [
                'readonly' => 'readonly',
            ],
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
            'name' => 'separator_contract_type',
            'type' => 'custom_html',
            'value' => '',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);

        CRUD::addField([
            'name' => 'agent',
            'entity' => 'agent',
            'type' => "relationship",
            'attribute' => "contactFullName",
            'placeholder' => '-Ընտրել մեկը-',
            'label' => "Գործակալ",
            'minimum_input_length' => 0,
            'ajax' => true,
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
            'inline_create' => true,
            'minimum_input_length' => 0,
            'label' => "Վաճառող",
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
        ]);


        CRUD::addField([
            'name' => 'owner',
            'entity' => 'owner',
            'type' => "relationship",
            'attribute' => "fullContact",
            'placeholder' => '-Ընտրել մեկը-',
            'ajax' => true,
            'inline_create' => true,
            'minimum_input_length' => 0,
            'label' => "Վարձատու",
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        CRUD::addField([
            'name' => 'separator_owner_seller',
            'type' => 'custom_html',
            'value' => '',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
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
            'name' => 'address_building_separator',
            'type' => 'custom_html',
            'value' => '<br/>',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);

        CRUD::addField([
            'name' => 'address_building',
            'type' => "text",
            'label' => "Հող",
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
            'name' => 'floor_separator',
            'type' => 'custom_html',
            'value' => '<br/>',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);




        CRUD::addField([
            'name' => 'area_total',
            'type' => "number",
            'label' => "Ընդհանուր մակերես",
            'wrapper' => [
                'class' => 'form-group col-md-2'
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
    }
    private function addCreateAdditionalFields(): void
    {
        /*Լրացուցիչ tab fields*/

        CRUD::addField([
            'name' => 'propertyAgent',
            'entity' => 'propertyAgent',
            'type' => "relationship",
            'ajax' => true,
            'minimum_input_length' => 0,
            'attribute' => "name_arm",
            'label' => "Տեղազննող գործակալ",
            'tab' => 'Լրացուցիչ',
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);


        CRUD::addField([
            'name' => 'infoSource',
            'type' => "relationship",
            'ajax' => true,
            'minimum_input_length' => 0,
            'attribute' => "contactFullName",
            'label' => "Ինֆորմացիայի աղբյուր",
            'tab' => 'Լրացուցիչ',
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'name' => 'intercom',
            'type' => "text",
            'label' => "Դոմոֆոն",
            'tab' => 'Լրացուցիչ',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'name' => 'separator77777',
            'type' => 'custom_html',
            'tab' => 'Լրացուցիչ',
            'value' => '<hr/>',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator mb-3'
            ],
        ]);

        CRUD::addField([
            'name' => 'is_advertised',
            'type' => 'switch',
            'label' => 'Գովազդված',
            'tab' => 'Լրացուցիչ',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'is_urgent',
            'type' => 'switch',
            'label' => 'Շտապ',
            'tab' => 'Լրացուցիչ',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'is_hot_offer',
            'type' => 'switch',
            'label' => 'Թոփ առաջարկներ',
            'tab' => 'Լրացուցիչ',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        $defaultEstateStatus = 1;

        if(request('action') == 'recover') {
            $defaultEstateStatus = 1;
        }

        CRUD::addField([
            'name' => 'estate_status',
            'type' => "relationship",
            'attribute' => "name_arm",
            'label' => "Կարգավիճակ",
            'default' => $defaultEstateStatus,
            'tab' => 'Լրացուցիչ',
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        if(request('action') == 'selled') {

            CRUD::addField([
                'name' => 'separator_rent_selled',
                'type' => 'custom_html',
                'tab' => 'Լրացուցիչ',
                'value' => '',
                'wrapper' => [
                    'class' => 'form-group col-md-12 separator mt-2'
                ],
            ]);
            CRUD::addField([
                'name' => 'price_amd_initial',
                'type' => "text",
                'default' => CRUD::getCurrentEntry()->price_amd,
                'attributes' => [
                'readonly'  => 'readonly',
                'disabled'  => 'disabled',
                ],
                'tab' => 'Լրացուցիչ',
                'label' => "Նախնական գին",
                'wrapper' => [
                    'class' => 'form-group col-md-3'
                ],
            ]);

            CRUD::addField([
                'name' => 'price_amd_selled',
                'type' => "text",
                'default' => 0,
                'tab' => 'Լրացուցիչ',
                'label' => "Վերջնական գին",
                'wrapper' => [
                    'class' => 'form-group col-md-3'
                ],
            ]);

        CRUD::addField([
            'name' => 'buyer',
            'entity' => 'buyer',
            'type' => "relationship",
            'attribute' => "fullContact",
            'placeholder' => '-Ընտրել մեկը-',
            'ajax' => true,
            'inline_create' => true,
            'minimum_input_length' => 0,
            'tab' => 'Լրացուցիչ',
            'label' => "Գնորդ",
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
        ]);



        }

        CRUD::addField([
            'name' => 'separator_rent_table',
            'type' => 'custom_html',
            'tab' => 'Լրացուցիչ',
            'value' => '',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
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
                'tab' => 'Լրացուցիչ',
            ]);

        }

        CRUD::addField([
            'name' => 'separator_archive',
            'type' => 'custom_html',
            'tab' => 'Լրացուցիչ',
            'value' => '',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);

        CRUD::addField([
            'name' => 'archive_till_date',
            'type' => "date",
            'label' => "Արխիվացնել մինչև",
            'tab' => 'Լրացուցիչ',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'name' => 'archive_comment_arm',
            'type' => "textarea",
            'label' => "Արխիվացման նշումներ",
            'tab' => 'Լրացուցիչ',
            'wrapper' => [
                'class' => 'form-group col-md-9'
            ],
        ]);

        CRUD::addField([
            'name' => 'separator77776',
            'type' => 'custom_html',
            'tab' => 'Լրացուցիչ',
            'value' => '<h4>SEO</h4>',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);

        CRUD::addField([
            'name' => 'meta_title_arm',
            'type' => "textarea",
            'label' => "Վերնագիր SEO",
            'tab' => 'Լրացուցիչ',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'meta_description_arm',
            'type' => "textarea",
            'label' => "Նկարագրություն SEO",
            'tab' => 'Լրացուցիչ',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);
    }

    private function addCreateTranslationFields() {
        /*Translations*/

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
    }

    private function addCreateProfessionalFields() {

        /*Մասնագիտական tab fields*/

        CRUD::addField([
            'name' => 'name_arm',
            'type' => "textarea",
            'row' => 12,
            'label' => "Մասնագիտական կարծիք, Վերլուծություն",
            'tab' => 'Մասնագիտական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'additional_info_arm',
            'type' => "textarea",
            'row' => 12,
            'label' => "Ինչու ես ձեռք չէի բերի այս գույքը",
            'tab' => 'Մասնագիտական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);


        CRUD::addField([
            'name' => 'comment_arm',
            'type' => "textarea",
            'row' => 12,
            'label' => "Այլ նոթեր",
            'tab' => 'Մասնագիտական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);


        CRUD::addField([
            'name' => 'is_public_text_generation',
            'type' => "switch",
            'label' => "Ավտո տեքստ",
            'tab' => 'Մասնագիտական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'public_text_arm',
            'type' => "textarea",
            'attributes' => [
                'rows' => 7,
            ],
            'label' => "Հայտարարության տեքստ (հայերեն)",
            'tab' => 'Մասնագիտական',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);
    }

    private function addCreateMapField() {

        /*Քարտեզ tab field*/

        CRUD::addField([
            'name' => 'location',
            'label' => 'Տեղը քարտեզի վրա',
            'type' => 'google_map',
            'tab' => 'Քարտեզ',
            'value' => '{"lat":40.179674748428745,"lng":44.504069898889185}',
            'map_options' => [
                'default_lat' => 40.1783632,
                'default_lng' => 44.51106509999999,
                'locate' => true,
                'height' => 400,
            ]
        ]);
    }

    private function addCreateDropzoneField() {
        /*Նկարներ tab fields*/

        CRUD::addField([
            'name' => 'temporary_photos',
            'label' => 'Նկարներ',
            'type' => "dropzone",
            'configuration' => [
                'parallelUploads' => 10,
                'uploadMultiple' => true,
                'createImageThumbnails' => true,
                'maxFilesize' => 1680000,

            ],
            'withFiles' => ([
                'disk' => 'S3Public',
                'path' => 'uploads/tmp',
                'uploader' => 'App\Services\RedAjaxUploader',
            ]),
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Նկարներ',

        ]);

        CRUD::addField([
            'name' => 'main_image_file_path',
            'label' => 'Նկարներ',
            'type' => "hidden",
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Նկարներ',

        ]);

        CRUD::addField([
            'name' => 'main_image_file_name',
            'label' => 'Նկարներ',
            'type' => "hidden",
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Նկարներ',

        ]);

        CRUD::addField([
            'name' => 'main_image_file_path_thumb',
            'label' => 'Նկարներ',
            'type' => "hidden",
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Նկարներ',

        ]);
    }
}

<?php

namespace App\Traits\Controllers;

use App\Models\Contact;
use App\Models\RealtorUser;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;

trait AddEstateViewAdditionalColumns
{
    private function addAdditionalTabColumns(): void
    {
        $estate = $this->crud->getCurrentEntry();

        CRUD::addColumn([
            'name' => 'propertyAgent',
            'entity' => 'propertyAgent',
            'type' => "relationship",
            'attribute' => "contactFullName",
            'label' => "Տեղազննող գործակալ",
            'tab' => 'Լրացուցիչ',
            'placeholder' => '-Ընտրել մեկը-',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);


        CRUD::addColumn([
            'name' => 'infoSource',
            'type' => "relationship",
            'ajax' => true,
            'minimum_input_length' => 0,
            'attribute' => "contactFullName",
            'label' => "Ինֆորմացիայի աղբյուր",
            'tab' => 'Լրացուցիչ',
            'placeholder' => '-Ընտրել մեկը-',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'intercom',
            'type' => "text",
            'label' => "Դոմոֆոն",
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'is_advertised',
            'type' => 'switch',
            'label' => 'Գովազդված',
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'address_apartment',
            'type' => 'text',
            'label' => 'Բնակարան/Տարածքի համար',
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'is_urgent',
            'type' => 'switch',
            'label' => 'Շտապ',
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'is_hot_offer',
            'type' => 'switch',
            'label' => 'Թոփ առաջարկներ',
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'estate_status',
            'type' => "relationship",
            'attribute' => "name_arm",
            'label' => "Կարգավիճակ",
            'tab' => 'Լրացուցիչ',
            'placeholder' => '-Ընտրել մեկը-',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'archive_till_date',
            'type' => "text",
            'label' => "Արխիվացնել մինչև",
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'archive_comment_arm',
            'type' => "text",
            'label' => "Արխիվացման նշումներ",
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);


        CRUD::addColumn([
            'name' => 'meta_title_arm',
            'type' => "textarea",
            'label' => "Վերնագիր SEO",
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'meta_description_arm',
            'type' => "textarea",
            'label' => "Նկարագրություն SEO",
            'tab' => 'Լրացուցիչ',
            'className' => 'form-group col-md-12 apartment_building_attribute  pt-4  border-solid  border-t-4'
        ]);

        if (in_array($estate->contract_type_id, [2, 3])) {


            Widget::add([
                'type' => 'relation_table',
                'name' => 'rentContracts',
                'label' => 'Վարձակալություն',
                'backpack_crud' => 'rentContracts',
                'relation_attribute' => 'estate_id',
                'buttons' => false,
                'button_create' => false,
                'button_delete' => false,
                'columns' => [
                    [
                        'label' => 'ID',
                        'name' => 'id',
                    ],
                    [
                        'label' => 'Նախնական գին',
                        'name' => 'initial_price',
                    ],
                    [
                        'label' => 'Վերջնական գին',
                        'name' => 'final_price',
                    ],
                    [
                        'label' => 'Սկիզբ',
                        'closure' => function($entry){
                            if(!empty($entry->start_date)) {
                                return Carbon::parse($entry->start_date)->format('d/n/Y');
                            }
                            return null;
                        }
                    ],
                    [
                        'label' => 'Ավարտ',
                        'closure' => function($entry){
                            if(!empty($entry->end_date)) {
                                return Carbon::parse($entry->end_date)->format('d/n/Y');
                            }
                            return null;
                        }
                    ],
                    [
                        'label' => 'Վարձակալ',
                        'name' => 'renter.full_name',
                    ],
                    [
                        'label' => 'Գործակալ',
                        'name' => 'agent.contactFullName',
                    ],
                    [
                        'label' => 'Մեկնաբանություն',
                        'name' => 'comment_arm',
                    ],
                ],
            ])->to('after_content');
        }
    }

    private function addEstatePotentialClients() {

        $estate = $this->crud->getCurrentEntry();
        $estateContractType = $estate->contract_type_id;


        Widget::add([
            'type' => 'potential_clients',
            'name' => 'potential_clients',
            'label' => 'Պոտենցիալ հաճախորդներ',
            'backpack_crud' => $estateContractType === 1 ? 'buyer' : 'renter',
            'relation_attribute' => 'id',
            'buttons' => true,
            'button_create' => false,
            'button_delete' => false,
            'button_edit' => false,
            'per_page' => 10,
            'columns' => $this->addPotentialClientsListColumns()
        ])->to('after_content');
    }

    private function addPotentialClientsListColumns()  {



        return [


            [
                'name' => 'id',
                'type' => "number",
                'label' => "Կոդ",
                'limit' => 100,
            ],

            [
                'name' => 'full_name',
                'type' => "text",
                'label' => "Անուն",
                'limit' => 500,
            ],

            [
                'name' => 'phone_mobile_1',
                'type' => "text",
                'label' => "Հեռախոս",
                'limit' => 500,
            ],

            [
                'name' => 'created_at', // The db column name
                'label' => 'Ստեղծված', // Table column heading
                'type' => 'text',
            ],

            [
                'name' => 'updated_at', // The db column name
                'label' => 'Թարմացված', // Table column heading
                'type' => 'text',
            ],
        ];


    }

}

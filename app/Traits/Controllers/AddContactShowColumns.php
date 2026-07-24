<?php

namespace App\Traits\Controllers;

use App\Models\Contact;
use App\Models\RealtorUser;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;

trait AddContactShowColumns
{
    private function addShowColumns()
    {

        CRUD::addColumn([
            'name' => 'id',
            'type' => "text",
            'label' => "Կոդ",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հիմնական',
            'orderable' => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                return $query->orderBy('contact_type_id', $columnDirection);
            }
        ]);


        CRUD::addColumn([
            'name' => 'name_arm',
            'type' => "text",
            'label' => "Անուն",
            'limit' => 100,
            'orderable' => true,
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հիմնական',
        ]);
        CRUD::addColumn([
            'name' => 'last_name_arm',
            'type' => "text",
            'label' => "Ազգանուն",
            'limit' => 100,
            'orderable' => true,
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հիմնական',
        ]);


        CRUD::addColumn([
            'name' => 'contact_type',
            'type' => "relationship",
            'label' => "Կոնտակտի տեսակը",
            'attribute' => "name_arm",
            'limit' => 100, 'className' => 'col-md-7 mb-4',
            'tab' => 'Հիմնական',
            'orderable' => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                return $query->orderBy('contact_type_id', $columnDirection);
            }
        ]);

        CRUD::addColumn([
            'name' => 'phone_mobile_1',
            'type' => "phone",
            'attribute' => "phone_mobile_1",
            'label' => "Բջջ. հեռ. 1",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);

        CRUD::addColumn([
            'name' => 'phone_mobile_2',
            'type' => "text",
            'attribute' => "phone_mobile_2",
            'label' => "Բջջ. հեռ. 2",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);

        CRUD::addColumn([
            'name' => 'phone_mobile_3',
            'type' => "text",
            'attribute' => "phone_mobile_3",
            'label' => "Բջջ. հեռ. 3",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);

        CRUD::addColumn([
            'name' => 'phone_mobile_4',
            'type' => "text",
            'attribute' => "phone_mobile_4",
            'label' => "Բջջ. հեռ. 4",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);

        CRUD::addColumn([
            'name' => 'phone_home',
            'type' => "text",
            'attribute' => "phone_home",
            'label' => "Տան հեռ.",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);

        CRUD::addColumn([
            'name' => 'phone_office',
            'type' => "text",
            'attribute' => "phone_office",
            'label' => "Գրասենյակի հեռ.",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);

        CRUD::addColumn([
            'name' => 'viber',
            'type' => "text",
            'attribute' => "viber",
            'label' => "Viber",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);

        CRUD::addColumn([
            'name' => 'skype',
            'type' => "text",
            'attribute' => "skype",
            'label' => "Skype",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);

        CRUD::addColumn([
            'name' => 'whatsapp',
            'type' => "text",
            'attribute' => "whatsapp",
            'label' => "Whatsapp",
            'tab' => 'Հիմնական',
            'className' => 'col-md-7 mb-4',
        ]);


        CRUD::addColumn([
            'name' => 'email',
            'type' => "text",
            'label' => "Էլ․ հասցե",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հիմնական',
        ]);


        CRUD::addColumn([
            'name' => 'comment_arm',
            'type' => "text",
            'label' => "Մեկնաբանություն",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հիմնական',
            'limit' => 10000
        ]);


        CRUD::addColumn([
            'name' => 'created_on',
            'type' => "text",
            'label' => "Ստեղծված",
            'className' => 'col-md-7 mb-4 mb-4',
            'tab' => 'Հիմնական',
        ]);

        CRUD::addColumn([
            'name' => 'last_modified_on',
            'type' => "text",
            'label' => "Թարմացված",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հիմնական',
        ]);


    }

    private function addClientShowColumns()
    {

        CRUD::addColumn([
            'name' => 'client.is_urgent',
            'attribute' => 'is_urgent',
            'type' => "switch",
            'label' => "Շտապ",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.contact_status',
            'attribute' => 'name_arm',
            'type' => "relationship",
            'label' => "Հաճախորդի կարգավիճակ",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.archive_till_date',
            'attribute' => 'archive_till_date',
            'type' => "relationship",
            'label' => "Արխիվացնել մինչև",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.archive_comment',
            'attribute' => 'archive_comment',
            'type' => "relationship",
            'limit' => 5000,
            'label' => "Արխիվացման նշումներ",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);


        CRUD::addColumn([
            'name' => 'client.estate_type',
            'attribute' => 'name_arm',
            'type' => "relationship",
            'label' => "Գույքի տեսակ",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.contract_type',
            'attribute' => 'name_arm',
            'type' => "relationship",
            'label' => "Կոնտրակտի տեսակ",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.broker.contact.fullName',
            'attribute' => 'name_arm',
            'type' => "relationship",
            'limit' => 5000,
            'label' => "Գործակալ",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.infoSource',
            'attribute' => 'name',
            'type' => "relationship",
            'limit' => 5000,
            'label' => "Ինֆորմացիայի աղբյուր",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);


        CRUD::addColumn([
            'name' => 'client.location_province',
            'attribute' => 'name_arm',
            'type' => "relationship",
            'label' => "Մարզ",
            'className' => 'col-md-7 mb-4 border-t-4 pt-4 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.location_building',
            'type' => "relationship",
            'label' => "Շենք",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.location_street',
            'attribute' => 'location_street',
            'type' => "relationship",
            'label' => "Փողոց",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);


        CRUD::addColumn([
            'name' => 'client.community_list',
            'type' => "text",
            'label' => "Համայնք",
            'limit' => 20000,
            'className' => 'col-md-7 mb-4 ',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.price_from_usd',
            'type' => "relationship",
            'suffix' => " USD",
            'label' => "Գինը սկսած",
            'className' => 'col-md-7 mb-4 border-t-4 pt-4 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.price_to_usd',
            'type' => "relationship",
            'suffix' => " USD",
            'label' => "Գինը մինչև",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.area_from',
            'type' => "relationship",
            'label' => "Մակերեսը սկսած",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.area_to',
            'type' => "relationship",
            'label' => "Մակերեսը մինչև",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.room_count_from',
            'type' => "relationship",
            'label' => "Սենյակներ սկսած",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);

        CRUD::addColumn([
            'name' => 'client.room_count_to',
            'type' => "relationship",
            'label' => "Սենյակներ մինչև",
            'className' => 'col-md-7 mb-4',
            'tab' => 'Հաճախորդ',
        ]);


        if (isset(CRUD::getCurrentEntry()->client) && CRUD::getCurrentEntry()->client->estate_type_id === 4) {

            CRUD::addColumn([
                'name' => 'client.land_use_types_list',
                'type' => "text",
                'label' => "Հողի օգտագործման նպատակը",
                'limit' => 20000,
                'className' => 'col-md-7 mb-4',
                'tab' => 'Հաճախորդ',
            ]);
        } else {
            CRUD::addColumn([
                'name' => 'client.building_types_list',
                'type' => "text",
                'label' => "Արտաքին պատեր",
                'limit' => 2000,
                'className' => 'col-md-7 mb-4 border-t-4 pt-4 mb-4',
                'tab' => 'Հաճախորդ',
            ]);

            CRUD::addColumn([
                'name' => 'client.repairing_types_list',
                'type' => "text",
                'label' => "Վերանորոգման տեսակ",
                'limit' => 20000,
                'className' => 'col-md-7 mb-4',
                'tab' => 'Հաճախորդ',
            ]);

            CRUD::addColumn([
                'name' => 'client.building_project_types_list',
                'type' => "text",
                'label' => "Շենքի նախագիծը",
                'limit' => 20000,
                'className' => 'col-md-7 mb-4',
                'tab' => 'Հաճախորդ',
            ]);
        }


    }


    private function addClientPotentialEstates() {
            Widget::add([
                'type' => 'potential_estates',
                'name' => 'potential_estates',
                'label' => 'Պոտենցիալ գույքեր',
                'backpack_crud' => 'estate',
                'relation_attribute' => 'id',
                'buttons' => true,
                'button_create' => false,
                'button_delete' => false,
                'button_edit' => false,
                'per_page' => 10,
                'columns' => $this->addPotentialEstatesListColumns()
            ])->to('after_content');
    }


    private function addPotentialEstatesListColumns()  {


        return [
            [
                'name' => 'status_text',
                'type' => "text",
                'label' => "",
                'limit' => 100,
                'wrapper' => [
                    'element' => 'div',

                ],
            ],

            [
                'name' => 'full_code',
                'type' => "markdown",
                'value' => function ($entry) {
                    return '<div style="text-align: center"><a href="/admin/estate/' . $entry->id . '/show">' . $entry->full_code . '</a></div>';
                },
                'label' => "Կոդ",
                'limit' => 100,
            ],

            [
                'name' => 'full_address',
                'type' => "text",
                'label' => "Հասցե",
                'limit' => 500,
            ],

            [
                'name' => 'full_price_with_change',
                'type' => "markdown",
                'label' => "Գին",
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->orderBy('price', $columnDirection);
                }
            ],

            [
                'name' => 'area_total',
                'type' => "text",
                'label' => "Մակերես",
                'escaped' => false,
                'suffix' => ' m<sup>2</sup>',
            ],

            [
                'name' => 'price_per_square',
                'type' => "text",
                'label' => "$/S",
                'suffix' => session('currency') ?  ' '.session('currency') : ' AMD',
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

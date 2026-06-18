<?php

namespace App\Traits\Controllers;

use App\Models\Contact;
use App\Models\RealtorUser;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;

trait AddEstateViewSellerColumns
{
    private function addSellerTabColumns(): void
    {

        /*Լրացուցիչ tab fields*/

        CRUD::addColumn([
            'name' => 'seller.name_arm',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "name_arm",
            'label' => "Անուն",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);
        CRUD::addColumn([
            'name' => 'seller.last_name_arm',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "last_name_arm",
            'label' => "Ազգանուն",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.email',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "email",
            'label' => "Էլ. հասցե",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.phone_mobile_1',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "phone_mobile_1",
            'label' => "Բջջ. հեռ. 1",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.phone_mobile_2',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "phone_mobile_2",
            'label' => "Բջջ. հեռ. 2",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.phone_mobile_3',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "phone_mobile_3",
            'label' => "Բջջ. հեռ. 3",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.phone_mobile_4',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "phone_mobile_4",
            'label' => "Բջջ. հեռ. 4",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.phone_home',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "phone_home",
            'label' => "Տան հեռ.",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.phone_office',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "phone_office",
            'label' => "Գրասենյակի հեռ.",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.viber',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "viber",
            'label' => "Viber",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.skype',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "skype",
            'label' => "Skype",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.whatsapp',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "whatsapp",
            'label' => "Whatsapp",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.comment_arm',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "comment_arm",
            'label' => "Մեկանբանություն",
            'tab' => 'Վաճառող',
            'limit' => 10000,
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);

        CRUD::addColumn([
            'name' => 'seller.id',
            'entity' => 'seller',
            'type' => "relationship",
            'attribute' => "id",
            'label' => "ID",
            'tab' => 'Վաճառող',
            'className' => 'form-group col-md-4 apartment_building_attribute '
        ]);




    }
}

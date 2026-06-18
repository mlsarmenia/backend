<?php

namespace App\Traits\Controllers;

use App\Models\Contact;
use App\Models\RealtorUser;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;

trait AddEstateViewProfessionalColumns
{
    private function addProfessinalTabColumns(): void
    {

        /*Մասնագիտական tab fields*/

        CRUD::addColumn([
            'name' => 'name_arm',
            'type' => "collapse",
            'hideLabel' => true,
            'limit' => 5000,
            'row' => 12,
            'label' => "Մասնագիտական կարծիք, Վերլուծություն",
            'tab' => 'Մասնագիտական',
            'className' => 'form-group col-md-12 apartment_building_attribute pt-4  border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'additional_info_arm',
            'type' => "collapse",
            'hideLabel' => true,
            'limit' => 5000,
            'row' => 12,
            'label' => "Ինչու ես ձեռք չէի բերի այս գույքը",
            'tab' => 'Մասնագիտական',
            'className' => 'form-group col-md-12 apartment_building_attribute pt-4  border-solid  border-t-4'
        ]);


        CRUD::addColumn([
            'name' => 'comment_arm',
            'type' => "collapse",
            'hideLabel' => true,
            'row' => 12,
            'label' => "Այլ նոթեր",
            'tab' => 'Մասնագիտական',
            'limit' => 10000,
            'className' => 'form-group col-md-12 apartment_building_attribute pt-4  border-solid  border-t-4'
        ]);




        CRUD::addColumn([
            'name' => 'public_text_arm',
            'type' => "collapse",
            'hideLabel' => true,
            'label' => "Հայտարարության տեքստ (հայերեն)",
            'tab' => 'Մասնագիտական',
            'limit' => 10000,
            'className' => 'form-group col-md-12 apartment_building_attribute pt-4  border-solid  border-t-4'
        ]);
    }
}

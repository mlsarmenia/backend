<?php

namespace App\Traits\Controllers;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait AddClientCreateCommonFields
{
    private function addClientCreateCommonFields(): void
    {

        CRUD::addField([
            'name' => 'name_arm',
            'type' => "text",
            'label' => "Անուն",
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'last_name_arm',
            'type' => "text",
            'label' => "Ազգանուն",
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'name_en',
            'type' => "text",
            'label' => "Անուն (ENG)",
            'tab' => "Թարգմանություն",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'last_name_en',
            'type' => "text",
            'label' => "Ազգանուն (ENG)",
            'tab' => "Թարգմանություն",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'name_ru',
            'type' => "text",
            'label' => "Անուն (RU)",
            'tab' => "Թարգմանություն",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'last_name_ru',
            'type' => "text",
            'label' => "Ազգանուն (RU)",
            'tab' => "Թարգմանություն",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);



        CRUD::addField([
            'name' => 'email',
            'type' => "text",
            'label' => "Էլ. հասցե",
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'phone_mobile_1',
            'type' => "phone",
            'label' => "Բջջ. հեռ. 1",
            'config' => [
                'onlyCountries' => ['am', 'us', 'ru'],
                'separateDialCode' => true,
            ],
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'phone_mobile_2',
            'type' => "phone",
            'label' => "Բջջ. հեռ. 2",
            'config' => [
                'onlyCountries' => ['am', 'us', 'ru'],
                'separateDialCode' => true,
            ],
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'phone_mobile_3',
            'type' => "phone",
            'config' => [
                'onlyCountries' => ['am', 'us', 'ru'],
                'separateDialCode' => true,
            ],
            'label' => "Բջջ. հեռ. 3",
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'viber',
            'type' => "phone",
            'config' => [
                'onlyCountries' => ['am', 'us', 'ru'],
                'separateDialCode' => true,
            ],
            'label' => "Viber",
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'whatsapp',
            'type' => "phone",
            'config' => [
                'onlyCountries' => ['am', 'us', 'ru'],
                'separateDialCode' => true,
            ],
            'label' => "WhatsApp",
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'comment_arm',
            'type' => "textarea",
            'label' => "Մեկնաբանություն",
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);


    }
}

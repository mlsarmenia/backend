<?php

namespace App\Traits\Controllers;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

trait AddContactListColumns
{
    private function addListColumns()  {
        CRUD::removeSaveActions(['save_and_back','save_and_new', 'save_and_preview']);
        CRUD::setOperationSetting('showSaveActionChange', false);
        CRUD::addSaveActions([
            [
                'name' => 'save_and_list',
                'visible' => function($crud) {
                    return true;
                },
                'redirect' => function($crud, $request, $itemId) {
                    return $crud->route;
                },
            ],
        ]);

        if ($this->crud->hasAccess('create')) {
            $this->crud->addButton('top', 'contact_create_buttons_set', 'view', 'crud::buttons.contact_create_buttons_set');
        }

        $this->crud->removeButton('create');
        CRUD::enableExportButtons();

        CRUD::addColumn([
            'name' => 'id',
            'type' => "text",
            'label' => "Կոդ",
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                return $query->orderBy('contact_type_id', $columnDirection);
            }
        ]);


        CRUD::addColumn([
            'name' => 'full_contact',
            'type' => "text",
            'label' => "Անուն",
            'attribute' => "full_contact",
            'limit' => 100,
            'orderable'  => true,
            'searchLogic' => function ($query, $column, $searchTerm) {
                $exp = "CONCAT_WS(' ', TRIM(name_arm), TRIM(last_name_arm), TRIM(phone_mobile_1))";
                return $query->orWhereRaw($exp . " LIKE '%$searchTerm%'");
            }
        ]);


        CRUD::addColumn([
            'name' => 'contact_type',
            'type' => "relationship",
            'label' => "Կոնտակտի տեսակը",
            'attribute' => "name_arm",
            'limit' => 100,
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                return $query->orderBy('contact_type_id', $columnDirection);
            }
        ]);

        CRUD::addColumn([
            'name' => 'phone_mobile_1',
            'type' => "text",
            'label' => "Հեռախոս",
        ]);


        Widget::add()->type('script')->content('assets/js/admin/lists/client.js');

        CRUD::addColumn([
            'name' => 'client.archive_till_date',
            'attribute' => 'archive_till_date',
            'type' => "relationship",
            'label' => "Արխիվ․ մինչև",
        ]);

        CRUD::addColumn([
            'name' => 'email',
            'type' => "text",
            'label' => "Էլ․ հասցե",
        ]);

        CRUD::addColumn([
            'name' => 'created_at',
            'type' => "text",
            'label' => "Ստեղծված",
        ]);

        CRUD::addColumn([
            'name' => 'updated_at',
            'type' => "text",
            'label' => "Թարմացված",
        ]);

        $this->addListFilters();
    }
}

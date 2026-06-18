<?php

namespace App\Traits\Controllers;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait AddDefaultSaveActions
{
    public function addDefaultSaveActions()  {
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

    }
}

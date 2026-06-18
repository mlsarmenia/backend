<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait EntryActivityOperation
{
    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupEntryActivityOperationDefaults(): void
    {
        CRUD::allowAccess('logsActivityOperation');

        CRUD::operation(['list', 'show'], function () {
            CRUD::addButton('line', 'view_entry_logs', 'view', 'crud::buttons.view_entry_logs');
        });
    }
}

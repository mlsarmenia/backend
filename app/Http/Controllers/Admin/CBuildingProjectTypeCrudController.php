<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\CrudPermissionTrait;
use App\Http\Requests\CBuildingProjectTypeRequest;
use App\Models\CBuildingProjectType;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class CBuildingProjectTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CBuildingProjectTypeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use AuthorizesRequests;
    use CrudPermissionTrait;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(CBuildingProjectType::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/c-building-project-type');
        CRUD::setEntityNameStrings('c building project type', 'c building project types');
        $this->setAccessUsingPermissions(CBuildingProjectType::class);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('is_deleted')->type('boolean');
        CRUD::column('last_modified_on');
        CRUD::column('version');
        CRUD::column('sort_id');
        CRUD::column('name_arm');
        CRUD::column('name_eng');
        CRUD::column('name_ru');
        CRUD::column('name_ar');
        CRUD::column('last_modified_by');
        CRUD::column('comment');
        CRUD::column('created_by');
        CRUD::column('created_on');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CBuildingProjectTypeRequest::class);

        CRUD::field('is_deleted')->type('boolean');
        CRUD::field('last_modified_on');
        CRUD::field('version');
        CRUD::field('sort_id');
        CRUD::field('name_arm');
        CRUD::field('name_eng');
        CRUD::field('name_ru');
        CRUD::field('name_ar');
        CRUD::field('last_modified_by');
        CRUD::field('comment');
        CRUD::field('created_by');
        CRUD::field('created_on');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

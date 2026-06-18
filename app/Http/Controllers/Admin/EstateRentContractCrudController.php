<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EstateRentContractRequest;
use App\Models\Contact;
use App\Models\RealtorUser;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\Pro\Http\Controllers\Operations\FetchOperation;

/**
 * Class EstateRentContractCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EstateRentContractCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use FetchOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\EstateRentContract::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/estate-rent-contract');
        CRUD::setEntityNameStrings('Վարձակալություն', 'estate rent contracts');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('estate_id');
        CRUD::column('initial_price');
        CRUD::column('initial_price_currency_id');
        CRUD::column('start_date');
        CRUD::column('end_date');
        CRUD::column('renter_id');
        CRUD::column('agent_id');
        CRUD::column('final_price');
        CRUD::column('final_price_currency_id');
        CRUD::column('index_col');
        CRUD::column('comment_arm');
        CRUD::column('comment_eng');
        CRUD::column('comment_ru');
        CRUD::column('comment_ar');

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
        CRUD::setValidation(EstateRentContractRequest::class);


        CRUD::addField([
            'type' => "text",
            'label' => "Նախնական գին",
            'name' => 'initial_price',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'type' => "text",
            'label' => "Վերջնական գին",
            'name' => 'final_price',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'type' => "date",
            'label' => "Սկիզբ",
            'name' => 'start_date',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'type' => "date",
            'label' => "Ավարտ",
            'name' => 'end_date',
            'wrapper' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        CRUD::addField([
            'type' => "relationship",
            'name' => 'renter',
            'label' => 'Վարձակալ',
            'attribute' => 'fullContact',
            'inline_create' => [ // specify the entity in singular
                'entity' => 'renter', // the entity in singular
                // OPTIONALS
                'force_select' => true,
                'modal_class' => 'modal-dialog modal-xl', // use modal-sm, modal-lg to change width
                'modal_route' => route('renter-inline-create'), // InlineCreate::getInlineCreateModal()
                'create_route' =>  route('renter-inline-create-save'), // InlineCreate::storeInlineCreate()
                'add_button_label' => 'Նոր վարձակալ', // configure the text for the `+ Add` inline button
                'include_main_form_fields' => ['field1', 'field2'], // pass certain fields from the main form to the modal, get them with: request('main_form_fields')
            ],
            'model'       => "App\Models\Contact",
            'minimum_input_length' => 0,
            'ajax' => true,
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'agent',
            'label' => 'Գործակալ',
            'type' => "relationship",
            'ajax' => true,
            'minimum_input_length' => 0,
            'attribute' => "contactFullName",
            'placeholder' => '-Ընտրել մեկը-',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'type' => "textarea",
            'label' => "Մեկնաբանություն",
            'name' => 'comment_arm',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);


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

    public function fetchAgent()
    {
        return $this->fetch([
            'model' => RealtorUser::class,
            'searchable_attributes' => [],
            'paginate' => 50, // items to show per page
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->whereHas('contact', function ($query) use($search) {
                        $query->where('contact_type_id', 3)
                            ->whereNotNull('name_arm')
                            ->whereRaw('CONCAT(`name_eng`," ",`last_name_eng`," ",`name_arm`," ",`last_name_arm`," ",`id`) LIKE "%' . $search . '%"');
                    })
                        ->whereHas('roles', function ($query) {
                            $query->whereIn('role_id', [4, 6, 7, 8]);
                        })
                        ->select('realtor_user.*');
                } else {
                    return $model->whereHas('contact', function ($query) {
                        $query->where('contact_type_id', 3)
                            ->whereNotNull('name_arm');
                    })
                        ->whereHas('roles', function ($query) {
                            $query->whereIn('role_id', [4, 6, 7, 8]);
                        })
                        ->select('realtor_user.*');
                }
            }
        ]);
    }

    public function fetchRenter()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 100, // items to show per page
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->whereIn('contact_type_id', [4,5])->whereRaw('CONCAT(`name_eng`," ",`last_name_eng`," ",`name_arm`," ",`last_name_arm`," ",`id`) LIKE "%' . $search . '%"');
                } else {
                    return $model->whereIn('contact_type_id', [4,5]);
                }
            }
        ]);
    }
}

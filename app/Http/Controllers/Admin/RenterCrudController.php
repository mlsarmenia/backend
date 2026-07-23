<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactRequest;
use App\Models\CLocationCity;
use App\Models\CLocationCommunity;
use App\Models\CLocationStreet;
use App\Models\Contact;
use App\Traits\Controllers\AddClientCreateCommonFields;
use App\Traits\Controllers\AddContactListColumns;
use App\Traits\Controllers\AddContactShowColumns;
use App\Traits\Controllers\HasContactFilters;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Backpack\Pro\Http\Controllers\Operations\FetchOperation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

/**
 * Class ContactCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RenterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use FetchOperation;
    use AuthorizesRequests;
    use HasContactFilters;
    use AddContactListColumns;
    use AddContactShowColumns;
    use AddClientCreateCommonFields;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Contact::class);
        $this->crud->addClause('where', 'contact_type_id', '!=', 6);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/renter');
        CRUD::setEntityNameStrings('կոնտակտ', 'կոնտակտներ');
        $this->setPermissions();
    }

    private function setPermissions(): void
    {
        $this->crud->denyAccess(['list', 'show', 'create', 'update']);

        if (Gate::allows('view', Contact::class)) {
            $this->crud->allowAccess(['list', 'show']);
        }

        if (Gate::allows('create', Contact::class)) {
            $this->crud->allowAccess('create');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->addListColumns();
    }


    protected function setupShowOperation()
    {
        $this->addShowColumns();
        $this->addClientShowColumns();
        $this->addClientPotentialEstates();
    }
    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ContactRequest::class);
        $this->crud->setCreateContentClass('col-md-8');
//        $this->authorize('create', Contact::class);

        Widget::add()->type('script')->content('assets/js/admin/forms/estate.js');
        CRUD::addField([
            'name' => 'contact_type',
            'type' => "relationship",
            'label' => "",
            'default' => 5,
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'placeholder' => '-Ընտրել մեկը-',
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-3 d-none'
            ],
        ]);

        CRUD::addField([
            'name' => 'is_renter',
            'type' => "switch",
            'default' => 1,
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-3 d-none'
            ],
        ]);

        $this->addClientCreateCommonFields();



        CRUD::addField([
            'name' => 'client',
            'subfields'   => [
                [
                    'name' => 'contact_status',
                    'type' => 'relationship',
                    'attribute' => 'name_arm',
                    'label' => "Հաճախորդի կարգավիճակ",
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                [
                    'name' => 'is_urgent',
                    'type' => 'switch',
                    'label' => 'Շտապ',
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],
                [
                    'name' => 'estate_type',
                    'type' => "relationship",
                    'attribute' => "name_arm",
                    'label' => "Գույքի տեսակ",
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],
                [
                    'name' => 'contract_type',
                    'type' => "select2",
                    'attribute' => "name_arm",
                    'label' => "Կոնտրակտի տեսակ",
                    'placeholder' => '-Ընտրել մեկը-',
                    'options'   => (function ($query) {
                        return $query->where('name_eng', '!=', 'Sale')->get();
                    }),
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],
                [
                    'name' => 'broker',
                    'type' => "relationship",
                    'ajax' => true,
                    'minimum_input_length' => 0,
                    'attribute' => "name_arm",
                    'label' => "Գործակալ",
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],
                [
                    'name' => 'referral',
                    'type' => "relationship",
                    'ajax' => true,
                    'minimum_input_length' => 0,
                    'attribute' => "name_arm",
                    'label' => "Ինֆորմացիայի աղբյուր",
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],
                [
                    'name' => 'infoSource',
                    'type' => 'relationship',
                    'minimum_input_length' => 0,
                    'attribute' => 'name',
                    'label' => 'Ինֆորմացիայի աղբյուր',
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                [
                    'name' => 'project',
                    'type' => 'relationship',
                    'minimum_input_length' => 0,
                    'attribute' => 'title_arm',
                    'label' => 'Նախագիծ',
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                [
                    'name' => 'location_province',
                    'type' => "relationship",
                    'attribute' => "name_arm",
                    'label' => "Մարզ",
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-4 '
                    ],
                ],
                [
                    'name' => 'location_city',
                    'type' => "relationship",
                    'attribute' => "name_arm",
                    'ajax' => true,
                    'minimum_input_length' => 0,
                    'include_all_form_fields' => true,
                    'label' => "Քաղաք",
                    'dependencies' => ['location_province'],
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-4 '
                    ],
                ],
                [
                    'name' => 'communities',
                    'type' => "relationship",
                    'attribute' => "name_arm",
                    'ajax' => true,
                    'minimum_input_length' => 0,
                    'dependencies' => ['location_province'],
                    'label' => "Համայնք",
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-4'
                    ],
                ],
                [
                    'name' => 'location_street',
                    'type' => "relationship",
                    'attribute' => "name_arm",
                    'ajax' => true,
                    'minimum_input_length' => 0,
                    'dependencies' => ['location_province'],
                    'label' => "Փողոց",
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-9'
                    ],
                ],
                [
                    'name' => 'address_building',
                    'type' => "text",
                    'label' => "Շենք",
                    'wrapper' => [
                        'class' => 'form-group col-md-3'
                    ],
                ],

                $this->clientBudgetCurrencyField(),

                [
                    'name' => 'price_from',
                    'type' => "text",
                    'label' => "Գինը սկսած",
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],

                [
                    'name' => 'price_to',
                    'type' => "text",
                    'label' => "Գինը մինչև",
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],

                [
                    'name' => 'area_from',
                    'type' => "text",
                    'label' => "Մակերեսը սկսած",
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],

                [
                    'name' => 'area_to',
                    'type' => "text",
                    'label' => "Մակերեսը մինչև",
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],

                [
                    'name' => 'room_count_from',
                    'type' => "text",
                    'label' => "Սենյակներ սկսած",
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],

                [
                    'name' => 'room_count_to',
                    'type' => "text",
                    'label' => "Սենյակներ մինչև",
                    'wrapper' => [
                        'class' => 'form-group col-md-6'
                    ],
                ],
                [
                    'name' => 'client_building_types',
                    'type' => 'relationship',
                    'attribute' => 'name_arm',
                    'minimum_input_length' => 0,
                    'label' => 'Արտաքին պատեր',
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
                [
                    'name' => 'client_repairing_types',
                    'type' => 'relationship',
                    'attribute' => 'name_arm',
                    'minimum_input_length' => 0,
                    'label' => 'Նորոգում',
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
                [
                    'name' => 'client_building_project__types',
                    'type' => 'relationship',
                    'attribute' => 'name_arm',
                    'minimum_input_length' => 0,
                    'label' => 'Շենքի նախագիծը',
                    'placeholder' => '-Ընտրել մեկը-',
                    'wrapper' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
            ],
            'type' => "repeatable",
            'label' => "",
            'tab' => "Գնորդ",
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'init_rows' => 1,
            'min_rows' => 1,
            'max_rows' => 1
        ]);

    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        if (Gate::allows('update', $this->crud->getCurrentEntry())) {
            $this->crud->allowAccess('update');
        }

        $this->setupCreateOperation();
    }

    public function fetchReferral()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('contact_type_id', '=', 3)->whereRaw('CONCAT(`name_arm`," ",`last_name_arm`) LIKE "%' . $search . '%"');
                } else {
                    return $model->where('contact_type_id', '=', 3);
                }
            }
        ]);
    }

    public function fetchBroker()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('contact_type_id', '=', 3)->whereRaw('CONCAT(`name_eng`," ",`last_name_eng`," ",`name_arm`," ",`last_name_arm`," ",`id`) LIKE "%' . $search . '%"');
                } else {
                    return $model->where('contact_type_id', '=', 3);
                }
            }
        ]);
    }

    public function fetchLocationCity()
    {
        return $this->fetch([
            'model' => CLocationCity::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $params = collect(request()->input('form'))->pluck('value', 'name');
                $provinceId = $params['client[0][location_province]'];

                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('parent_id', '=', $provinceId)->whereRaw('CONCAT(`name_eng`," ",`name_arm`) LIKE "%' . $search . '%"');
                } else {
                    return $model->where('parent_id', '=', $provinceId);
                }
            }
        ]);
    }

    public function fetchCommunities()
    {
        return $this->fetch([
            'model' => CLocationCommunity::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $params = collect(request()->input('form'))->pluck('value', 'name');
                $provinceId = $params['client[0][location_province]'] ?? null;
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->where('parent_id', '=', $provinceId)->whereRaw('CONCAT(`name_eng`," ",`name_arm`) LIKE "%' . $search . '%"');
                } else {
                    return $model->where('parent_id', '=', $provinceId);
                }
            }
        ]);
    }

    public function fetchLocationStreet()
    {
        return $this->fetch([
            'model' => CLocationStreet::class,
            'searchable_attributes' => [],
            'paginate' => 30, // items to show per page
            'searchOperator' => 'LIKE',
            'query' => function ($model) {
                $params = collect(request()->input('form'))->pluck('value', 'name');
                $cityId = $params['location_city'];
                $communityId = $params['location_community'];
                $search = request()->input('q') ?? false;
                if ($search && $communityId) {
                    return $model->where('parent_is_community', true)->where('community_id', '=', $communityId)->whereRaw('CONCAT(`name_eng`," ",`name_arm`) LIKE "%' . $search . '%"');
                } elseif ($search && $cityId) {
                    return $model->where('parent_is_community', false)->where('parent_id', '=', $cityId)->whereRaw('CONCAT(`name_eng`," ",`name_arm`) LIKE "%' . $search . '%"');
                } elseif ($communityId) {
                    return $model->where('parent_is_community', true)->where('community_id', '=', $communityId);
                } elseif ($cityId) {
                    return $model->where('parent_is_community', false)->where('parent_id', '=', $cityId);
                } else {
                    return $model->where('id', '<', 0);
                }
            }
        ]);
    }
}

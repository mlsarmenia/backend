<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\CrudPermissionTrait;
use App\Http\Requests\ProfessionalRequest;
use App\Models\Contact;
use App\Models\CProfessionType;
use App\Models\CRole;
use App\Models\RealtorUser;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Backpack\Pro\Http\Controllers\Operations\FetchOperation;

/**
 * Class RealtorUserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProfessionalCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use AuthorizesRequests;
    use CrudPermissionTrait;
    use FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(RealtorUser::class);
        $this->crud->addClause('whereHas', 'contact');
        CRUD::setRoute(config('backpack.base.route_prefix') . '/professional');
        CRUD::setEntityNameStrings('Մասնագետ', 'Մասնագետներ');
        $this->setAccessUsingPermissions(RealtorUser::class);
        $this->crud->replaceSaveActions([
            'name' => 'save_and_list',
            'redirect' => function($crud, $request, $itemId) {
                return session('referrer_url', 'admin');
            },
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::setShowView('redg.professional.showTabs');


        $professional = $this->crud->getCurrentEntry();
        $this->crud->data['professional'] = $professional;
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addFilter([
            'name' => 'role',
            'type' => 'select2_multiple_red',
            'label' => 'Դեր',
        ], function() { // the options that show up in the select2
            return CRole::all()->pluck('name_arm', 'id')->toArray();
        }, function($values) {
                $this->crud->query = $this->crud->query->whereHas('roles', function ($query) use ($values) {
                    $query->whereIn('role_id', json_decode($values));
                })->whereHas('contact');
        });

        $this->crud->addFilter([
            'name' => 'profession_type',
            'type' => 'select2_multiple_red',
            'label' => 'Մասնագիտության տեսակը',
        ], function() { // the options that show up in the select2
            return CProfessionType::all()->pluck('name_arm', 'id')->toArray();
        }, function($values) { // if the filter is active
                $this->crud->query = $this->crud->query->whereHas('professions', function ($query) use ($values) {
                    $query->whereIn('profession_id', json_decode($values));
                });
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_active',
            'label' => 'Ակտիվ'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'is_active', '=', 1);
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_blocked',
            'label' => 'Արգելափակված'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'is_blocked', '=', 1);
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_4',
        ]);

        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'created_at_from',
            'label' => 'Ստեղծված սկսած'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'created_at', '>=', $value);
            });


        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'created_at_to',
            'label' => 'Ստեղծված մինչև'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'created_at', '<=', $value . ' 23:59:59');
            });

        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'updated_at_from',
            'label' => 'Թարմացված սկսած'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'updated_at', '>=', $value);
            });


        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'updated_at_to',
            'label' => 'Թարմացված մինչև'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'updated_at', '<=', $value . ' 23:59:59');
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_end',
        ]);

        CRUD::column('id');

        CRUD::addColumn([
            'name' => 'professional_info',
            'type' => "markdown",
            'value' => function ($entry) {
            if($entry->profile_picture_path) {
                return '<div>
                    <a style="text-align: left; display: flex; flex-direction: column" href="/admin/professional/' . $entry->id . '/show">
                        <img style="margin-bottom:10px" height="100px" width="100px" src="' . Storage::disk('S3Public')->url($entry->profile_picture_path) . '" />'
                    . $entry->contact?->name_arm .' '. $entry->contact?->last_name_arm . ' '.$entry->contact?->organization. '
                    </a>
                </div>
                ';
            } else {
                return '<div>
                    <a style="text-align: left; display: flex; flex-direction: column" href="/admin/professional/' . $entry->id . '/show">'
                    . $entry->contact?->name_arm .' '. $entry->contact?->last_name_arm .' '.$entry->contact?->organization. '
                    </a>
                </div>
                ';
            }

            },
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('contact', function ($q) use ($column, $searchTerm) {
                    $exp = "CONCAT_WS(' ', TRIM(name_arm), TRIM(last_name_arm), TRIM(phone_mobile_1), TRIM(phone_mobile_2))";
                    $q->where(DB::raw($exp), 'LIKE', "%" . $searchTerm . "%");
                });
            },
            'label' => "Կոդ",
            'limit' => 100,
        ]);



        CRUD::addColumn([
            'name' => 'professions',
            'entity' => 'professions',
            'type' => "select_multiple",
            'model' => 'App\Models\CProfessionType',
            'attribute' => "name_arm",
            'label' => "Մասնագիտություններ",
            'limit' => 150,
            'pivot' => true,
        ]);

        CRUD::addColumn([
            'name' => 'roles',
            'entity' => 'roles',
            'type' => "select_multiple",
            'model' => 'App\Models\CRole',
            'attribute' => "name_arm",
            'label' => "Դերեր",
            'limit' => 150,
            'pivot' => true,
        ]);

        CRUD::addColumn([
            'name' => 'phone',
            'entity' => 'contact',
            'type' => "select",
            'model' => "App\Models\Contact",
            'attribute' => "phone_mobile_1",
            'label' => "Հեռ.",
            'limit' => 150,
        ]);
        CRUD::addColumn([
            'name' => 'email',
            'entity' => 'contact',
            'type' => "select",
            'model' => "App\Models\Contact",
            'attribute' => "email",
            'label' => "Էլ. հասցե",
            'limit' => 150,
        ]);

        CRUD::addColumn([
            'name' => 'is_active',
            'type' => 'switch',
            'label' => 'Ակտիվ',
        ]);

    }

    public function fetchContact()
    {
        return $this->fetch([
            'model' => Contact::class,
            'searchable_attributes' => [],
            'paginate' => 100, // items to show per page
            'query' => function ($model) {
                $search = request()->input('q') ?? false;
                if ($search) {
                    return $model->whereIn('contact_type_id', [3])->whereRaw('CONCAT_WS(" ", `name_eng`, `last_name_eng`, `name_arm`, `last_name_arm`, `id`) LIKE ?', ['%' . $search . '%']);
                } else {
                    return $model->whereIn('contact_type_id', [3]);
                }
            }
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProfessionalRequest::class);
        Widget::add()->type('script')->content('assets/js/admin/forms/estate.js');
        $this->crud->setCreateContentClass('col-md-8');

        CRUD::addField([
            'type' => "relationship",
            'name' => 'contact',
            'label' => 'Կոնտակտ',
            'attribute' => 'fullContact',
            'inline_create' => [
                'entity' => 'agent',
                'force_select' => true,
                'modal_class' => 'modal-dialog modal-xl',
                'modal_route' => route('agent-inline-create'),
                'create_route' =>  route('agent-inline-create-save'),
                'add_button_label' => 'Նոր կոնտակտ',
                'include_main_form_fields' => ['field1', 'field2'],
            ],
            'model' => "App\Models\Contact",
            'minimum_input_length' => 0,
            'ajax' => true,
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
        ]);

        CRUD::addField([
            'name' => 'is_active',
            'type' => 'switch',
            'label' => 'Ակտիվ',
            'tab' => 'Հիմնական',
        ]);

        CRUD::addField([
            'name' => 'separator1',
            'type' => 'custom_html',
            'value' => '<br/>',
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);



        CRUD::addField([
            'name' => 'separator2',
            'type' => 'custom_html',
            'tab' => "Հիմնական",
            'value' => '<br/>',
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);



        CRUD::addField([
            'name' => 'separator3',
            'type' => 'custom_html',
            'value' => '<br/>',
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);

        CRUD::addField([   // Checklist
            'label'     => 'Մասնագիտության տեսակը',
            'type'      => 'checklist',
            'name'      => 'professions',
            'entity'    => 'professions',
            'attribute' => 'name_arm',
            'model'     => "App\Models\CProfessionType",
            'pivot'     => true,
             'number_of_columns' => 3,
            'tab' => "Հիմնական",
        ]);

        CRUD::addField([
            'name' => 'separator4',
            'type' => 'custom_html',
            'value' => '<br/>',
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);

        CRUD::addField([   // Checklist
            'label'     => 'Դեր',
            'type'      => 'select_multiple',
            'name'      => 'inner_roles',
            'entity'    => 'roles',
            'attribute' => 'name_arm',
            'model'     => "App\Models\CRole",
            'pivot'     => true,
            'tab' => "Հիմնական",
            'options'   => (function ($query) {
                return $query->whereIn('id', [1,2,4,5])->get();
            }),
        ]);

        CRUD::addField([
            'name' => 'separator5',
            'type' => 'custom_html',
            'value' => '<br/>',
            'tab' => "Հիմնական",
            'wrapper' => [
                'class' => 'form-group col-md-12 separator'
            ],
        ]);

        CRUD::addField([
            'name' => 'profile_picture_path',
            'label'        => "Profile Image",
            'type'         => 'image',
            'disk'         => 'S3',
            'tab' => "Հիմնական",
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => true, // set to true to allow cropping, false to disable
            'withFiles' => ([
                'disk' => 'S3Public',
                'path' => 'estate/photos',
            ]),
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
        if (url()->previous() && !str_contains(url()->previous(), '/edit')) {
            session(['referrer_url' => url()->previous()]);
        }

        $this->crud->setCreateContentClass('col-md-8');
        $this->setupCreateOperation();
    }
}

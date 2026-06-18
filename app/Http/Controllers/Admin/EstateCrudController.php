<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Operations\DownloadEstateImagesOperation;
use App\Http\Controllers\Admin\Operations\RedDropZoneOperation;
use App\Http\Controllers\Admin\Traits\AuthorizesForDetailedEstateInfo;
use App\Http\Controllers\Admin\Traits\CrudPermissionTrait;
use App\Http\Requests\EstateRequest;
use App\Models\Estate;
use App\Models\EstateDocument;
use App\Models\User;
use App\Traits\Controllers\AddDefaultSaveActions;
use App\Traits\Controllers\AddEstateViewColumns;
use App\Traits\Controllers\AddEstateCreateApartmentFields;
use App\Traits\Controllers\AddEstateCreateCommonFields;
use App\Traits\Controllers\AddEstateFetchMethods;
use App\Traits\Controllers\AddEstateListColumns;
use App\Traits\Controllers\AddEstateMapView;
use App\Traits\Controllers\AddEstateViewAdditionalColumns;
use App\Traits\Controllers\AddEstateViewProfessionalColumns;
use App\Traits\Controllers\AddEstateViewSellerColumns;
use App\Traits\Controllers\CloneEstate;
use App\Traits\Controllers\HasEstateFilters;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Backpack\Pro\Http\Controllers\Operations\FetchOperation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class EstateCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EstateCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use RedDropZoneOperation;
    use FetchOperation;
    use AuthorizesRequests;
    use HasEstateFilters;
    use AddEstateCreateCommonFields;
    use AddEstateCreateApartmentFields;
    use AddEstateListColumns;
    use AddEstateFetchMethods;
    use DownloadEstateImagesOperation;
    use AddDefaultSaveActions;
    use CloneEstate;
    use AddEstateViewAdditionalColumns;
    use AddEstateViewSellerColumns;
    use AddEstateViewProfessionalColumns;
    use AddEstateViewColumns;
    use AddEstateMapView;
    use CrudPermissionTrait;
    use AuthorizesForDetailedEstateInfo;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Estate::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/estate');
        CRUD::setEntityNameStrings('estate', 'Բնակարան');
        $this->setPermissions();
        $this->crud->replaceSaveActions([
            'name' => 'save_and_list',
            'redirect' => function($crud, $request, $itemId) {
                return session('referrer_url', 'admin');
            },
        ]);
    }

    private function setPermissions(): void
    {
        $this->crud->denyAccess(['list', 'show', 'create', 'update']);

        if (Gate::allows('view', Estate::class)) {
            $this->crud->allowAccess(['show', 'list']);
        }

        if (Gate::allows('create', Estate::class)) {
            $this->crud->allowAccess('create');
        }
    }

    protected function setupShowOperation()
    {
        CRUD::setShowView('redg.estate.showTabs');
        $this->crud->addButton('line', 'download_estate_images', 'view', 'crud::buttons.download', 'end');
        Widget::add()->type('script')
            ->content('https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js')
            ->crossorigin('anonymous');
        /** @var Estate $estate */
        $estate = $this->crud->getCurrentEntry();
        /** @var User $user */
        $user = Auth::user();

        if($estate->estate_type_id === 2) {
            $this->addHouseColumns();
        }

        if($estate->estate_type_id === 1 || $estate->estate_type_id === 2) {
            $this->addBuildingColumns();
        }

        if($estate->estate_type_id === 3) {
            $this->addCommercialBuildingColumns();
        }


        if($estate->estate_type_id !== 1) {
            $this->addLandColumns();
        }
        if($estate->estate_type_id !== 4) {
            $this->addApartmentFacilitesColumns();
        }

        if ($this->canViewDetailedInfo($user, $estate)) {
            $this->addProfessinalTabColumns();
        }

        $this->addAdditionalTabColumns();

        if ($this->canViewDetailedInfo($user, $estate)) {
            $this->addSellerTabColumns();
        }

        $this->addEstateOnMapView();

        if ($this->canViewDetailedInfo($user, $estate)) {
            $this->addEstatePotentialClients();
        }

        $this->crud->data['estate'] = $estate;
        $this->crud->viewType = request()->type;

        $viewType = request()->type;
        if($viewType === 'viewOnly') {
            unset($this->crud->data['estate']->address_building);
            unset($this->crud->data['estate']->address_apartment);
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
        Widget::add()->type('script')->content('assets/js/admin/lists/estate.js');
        $this->crud->with([
            'estate_status',
            'estate_type',
            'contract_type',
            'location_province',
            'location_community',
            'location_street'
        ]);

        $this->crud->removeButton('clone');
        $this->crud->removeButton('create');
        $this->crud->addButton('top', 'estate_create_buttons_set', 'view', 'crud::buttons.estate_create_buttons_set');
        $this->crud->addButton('line', 'recover', 'view', 'crud::buttons.recover');
        $this->crud->addButton('line', 'estate_clone', 'view', 'crud::buttons.estate_clone');
        $this->crud->addButton('line', 'archive', 'view', 'crud::buttons.archive');
        $this->crud->addButton('line', 'sold', 'view', 'crud::buttons.selled');
        $this->crud->addButton('line', 'photo', 'view', 'crud::buttons.photo');
        $this->crud->addButton('line', 'message', 'view', 'crud::buttons.message');
        $this->crud->addButton('line', 'star', 'view', 'crud::buttons.star');
        $this->crud->addButton('line', 'view_entry_logs', 'view', 'crud::buttons.view_entry_logs');

        /*Columns*/
        $this->addListColumns();

        /*Filters*/
        $this->addListFilters();

        $filterValues = $this->crud->filters()->pluck('currentValue');
        $filtersApplied = $filterValues->contains(function ($value) {
            return !is_null($value);
        });

        if ($filtersApplied) {
            /**
             * If filters are applied, append the `totalEntryCount` parameter.
             * This avoids fetching the total count of all records, which is unnecessary when filters are applied.
             * This way we ensure that we only fetch the count of records that match the applied filters,
             * thus optimizing performance and reducing unnecessary database queries.
             *
             * @see \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation::search()
             */
            $this->crud->getRequest()->merge(['totalEntryCount' => true]);
        }
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EstateRequest::class);
        Widget::add()->type('script')->content('assets/js/admin/forms/estate.js');

        $this->addApartmentFields();
        $this->addCreateCommonFields(1);
    }

    protected function setupUpdateOperation()
    {
        if (Gate::allows('update', $this->crud->getCurrentEntry())) {
            $this->crud->allowAccess('update');
        }

        CRUD::setValidation(EstateRequest::class);
        $this->setupCreateOperation();
        $estate = $this->crud->getCurrentEntry();

        if (url()->previous() && !str_contains(url()->previous(), '/edit')) {
            session(['referrer_url' => url()->previous()]);
        }

        CRUD::removeField('estate_type');

        if (!empty($estate->estate_longitude) && !empty($estate->estate_latitude)) {


            CRUD::addField([
                'name' => 'location',
                'label' => 'Տեղը քարտեզի վրա',
                'type' => 'google_map',
                'tab' => 'Քարտեզ',
                'value' => '{"lat":' . $estate->estate_latitude . ',"lng":' . $estate->estate_longitude . '}',

                'map_options' => [
                    'default_lat' => $estate->estate_latitude,
                    'default_lng' => $estate->estate_longitude,
                    'locate' => true,
                    'height' => 400,
                ]
            ]);
        }
    }


    public function publishEstateDocument($id)
    {
        $estateDocument = EstateDocument::findOrFail($id);
        $estateDocument->is_public = 1;
        return $estateDocument->save();
    }

    public function unpublishEstateDocument($id)
    {
        $estateDocument = EstateDocument::findOrFail($id);
        $estateDocument->is_public = 0;
        return $estateDocument->save();
    }

    public function setMainImage($id)
    {
        $estateDocument = EstateDocument::findOrFail($id);
        $estate = Estate::findOrFail($estateDocument->estate_id);

        $estate->main_image_file_name = $estateDocument->path;
        $estate->main_image_file_path = $estate->id.'/'.$estateDocument->path;
        $estate->main_image_file_path_thumb = $estate->id.'/'.$estateDocument->path_thumb;

        return $estate->save();
    }

    public function deleteEstateDocuments($id)
    {
        $estate = Estate::findOrFail($id);
        $estate->temporary_photos = null;
        $estate->save();
        $estateDocumentIds = EstateDocument::where('estate_id', $id)->pluck('id')->toArray();
        EstateDocument::destroy($estateDocumentIds);
        return response()->json(['message' => 'Estate documents deleted successfully'], 200);
    }
}

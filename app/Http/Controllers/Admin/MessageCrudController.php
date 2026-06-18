<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\CrudPermissionTrait;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class MessageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MessageCrudController extends CrudController
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
        CRUD::setModel(Message::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/message');
        CRUD::setEntityNameStrings('նամակ', 'նամակներ');
        $this->setAccessUsingPermissions(Message::class);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {



        CRUD::addColumn([
            'name' => 'id',
            'type' => "text",
            'label' => "Կոդ",
            'wrapper' => [
                'element' => 'a',
                'className' => 'btn btn-link btn-sm bg-light',
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('message' . $related_key . '/'.$entry->id).'/show';
                },
            ],
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'recipient',
            'type' => "relationship",
            'attribute' => "contactFullName",
            'label' => "Հասցեատեր",
        ]);

        CRUD::addColumn([
            'name' => 'sender_name',
            'type' => "text",
            'label' => "Ուղարկող",
        ]);

        CRUD::addColumn([
            'name' => 'sender_email',
            'type' => "text",
            'label' => "Էլ. հասցե",
        ]);

        CRUD::addColumn([
            'name' => 'sender_phone',
            'type' => "text",
            'label' => "Հեռ.",
        ]);

        CRUD::addColumn([
            'name' => 'sent_on',
            'type' => "text",
            'label' => "Ուղղարկման ամսաթիվ",
        ]);


        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'feedback',
            'label' => 'Հետադարձ կապ'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'message_type_id', 1);
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'ask_more',
            'label' => ' Հարցնել ավելին'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'message_type_id', 2);
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'new_price',
            'label' => 'Նոր գնի առաջարկներ'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'message_type_id', 5);
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'agent_message',
            'label' => 'Նամակ գործակալին'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'message_type_id', 3);
            });


        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'overall_rate',
            'label' => 'Ընդհանուր գնահատական'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'message_type_id', 4);
            });












//        CRUD::column('message_type_id');
//        CRUD::column('feedback_type_id');
//        CRUD::column('service_id');
//        CRUD::column('overall_rating');
//        CRUD::column('offering_price');
//        CRUD::column('offering_currency_id');
//        CRUD::column('message_text');
//        CRUD::column('is_read');
//        CRUD::column('is_verified');
//        CRUD::column('sent_on');
//        CRUD::column('ip_address');

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
        CRUD::setValidation(MessageRequest::class);


//        CRUD::field('recipient_id');
//        CRUD::field('estate_id');
        CRUD::field('sender_name');
        CRUD::field('sender_email');
        CRUD::field('sender_phone');
        CRUD::field('message_type_id');
        CRUD::field('feedback_type_id');
        CRUD::field('service_id');
        CRUD::field('overall_rating');
        CRUD::field('offering_price');
        CRUD::field('offering_currency_id');
        CRUD::field('message_text');
        CRUD::field('is_read');
        CRUD::field('is_verified');
        CRUD::field('sent_on');
        CRUD::field('ip_address');

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

    protected function setupShowOperation()
    {

        CRUD::addColumn([
            'name' => 'sender_name',
            'type' => "text",
            'label' => "Ում կողմից",
            'tab' => "Կոնտակտային տվյալներ",
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4',
            'limit' => 500
        ]);

        CRUD::addColumn([
            'name' => 'sender_email',
            'type' => "text",
            'label' => "Էլ․ հասցե",
            'tab' => "Կոնտակտային տվյալներ",
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);
        CRUD::addColumn([
            'name' => 'sender_phone',
            'type' => "text",
            'label' => "Հեռախոս",
            'tab' => "Կոնտակտային տվյալներ",
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'sent_on',
            'type' => "text",
            'label' => "Ստացման ժամանակ",
            'tab' => "Կոնտակտային տվյալներ",
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'recipient',
            'type' => "relationship",
            'attribute' => "contactFullName",
            'label' => "Հասցեատեր",
            'tab' => "Հաղորդագրություն",
            'wrapper' => [
                'element' => 'a',
                'className' => 'btn btn-link btn-sm bg-light',
                'target' => '_blank',
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('professional/' . $related_key . '/show');
                },
            ],
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'message_text',
            'type' => "text",
            'label' => "Հաղորդագրություն",
            'tab' => "Հաղորդագրություն",
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);



        CRUD::addColumn([
            'name' => 'estate',
            'key' => 'public_text_arm',
            'type' => "relationship",
            'attribute' => "public_text_arm",
            'label' => "Անշարժ գույք",
            'tab' => "Հաղորդագրություն",
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'estate',
            'key' => 'rooms_count',
            'type' => "relationship",
            'attribute' => "room_count",
            'label' => "Սենյակներ",
            'tab' => "Հաղորդագրություն",
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'estate',
            'key' => 'area_total',
            'type' => "relationship",
            'attribute' => "area_total",
            'label' => "Մակերես",
            'tab' => "Հաղորդագրություն",
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

        CRUD::addColumn([
            'name' => 'estate',
            'key' => 'formatted_price',
            'type' => "relationship",
            'attribute' => "full_price",
            'label' => "Գին",
            'tab' => "Հաղորդագրություն",
            'limit' => 500,
            'className' => 'form-group col-md-12 apartment_building_attribute mt-4 pt-4 mb-4 border-solid  border-t-4'
        ]);

    }
}

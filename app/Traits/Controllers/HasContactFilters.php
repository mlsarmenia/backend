<?php

namespace App\Traits\Controllers;

use App\Models\Contact;
use App\Models\RealtorUser;

trait HasContactFilters
{
    private function addListFilters(): void
    {

        // select2 filter
        $this->crud->addFilter([
            'name' => 'contact_type',
            'type' => 'select2',
            'label' => 'Կոնտակտի տեսակը',
        ], function () {
            return \App\Models\CContactType::all()->pluck('name_arm', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'contact_type_id', $value);
        });

        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'name_arm',
            'label' => 'Անուն'
        ],
            false,
            function($value) {
                 $this->crud->addClause('where', 'name_arm', 'LIKE', "%$value%");
            });

        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'id',
            'label' => 'Կոնտակտ Կոդ'
        ],
            false,
            function($value) {
                $this->crud->addClause('where', 'id', 'LIKE', "%$value%");
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_phones',
        ]);

        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'phone_mobile_1',
            'label' => 'Հեռախոս'
        ],
            false,
            function($value) {
                $searchWithSpaces = str_replace(' ', '', $value);
                $this->crud->addClause('whereRaw', 'CONCAT(REPLACE(`phone_mobile_1`, " ", "")) LIKE ?',  "%$searchWithSpaces%");
            });



        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'viber',
            'label' => 'Viber'
        ],
            false,
            function($value) {
                $this->crud->addClause('where', 'viber', 'LIKE', "%$value%");
            });

        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'whatsapp',
            'label' => 'Whatsapp'
        ],
            false,
            function($value) {
                $this->crud->addClause('where', 'whatsapp', 'LIKE', "%$value%");
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_others',
        ]);



        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'email',
            'label' => 'Էլ. հասցե'
        ],
            false,
            function($value) {
                $this->crud->addClause('where', 'email', 'LIKE', "%$value%");
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_urgent',
            'label' => 'Շտապ'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'is_urgent', '=', 1);
            });

        $this->crud->addFilter([
            'type' => 'divider',
            'name' => 'divider_timestamps',
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


    }

}

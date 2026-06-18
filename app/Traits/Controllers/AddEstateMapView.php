<?php

namespace App\Traits\Controllers;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait AddEstateMapView
{

    private function addEstateOnMapView(): void
    {

        CRUD::addColumn([
            'name' => 'coordinates',
            'type' => "google_map",
            'label' => "Քարտեզ",
            'hideLabel' => true,
            'className' => 'col-md-10 mt-8',
            'tab' => 'Հիմնական',
        ]);
    }

}

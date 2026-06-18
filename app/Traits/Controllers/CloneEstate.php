<?php

namespace App\Traits\Controllers;

use App\Models\Estate;
use App\Models\EstateDocument;
use App\Services\FileService;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait CloneEstate
{
    public function clone($id)
    {
        $contract_type = request()->contract_type;
        $currentEntry = $this->crud->model->findOrFail($id);

        if($currentEntry->contract_type_id === 1 || $currentEntry->contract_type_id === 3) {
            $checkClone =  $this->crud->model->where([
                ['contract_type_id', '=', $contract_type],
                ['location_city_id', '=', $currentEntry->location_city_id],
                ['location_street_id', '=', $currentEntry->location_street_id],
                ['address_building', '=', $currentEntry->address_building],
                ['address_apartment', '=', $currentEntry->address_apartment],
            ])->first();
        } else {
            $checkClone =  $this->crud->model->where([
                ['contract_type_id', '=', $contract_type],
                ['location_city_id', '=', $currentEntry->location_city_id],
                ['location_street_id', '=', $currentEntry->location_street_id],
                ['address_building', '=', $currentEntry->address_building],
            ])->first();
        }

        if($checkClone) {
            return $checkClone->code;
        }

        $clonedEntry = $this->crud->model->findOrFail($id)->replicate();

        $clonedEntry->contract_type_id = (int)$contract_type;
        $clonedEntry->estate_status_id = 1;
        $clonedEntry->save();

        $currentEntry->estateDocuments->each(function ($document) use ($clonedEntry) {
            $clonedDocument = $document->replicate();
            $clonedDocument->estate_id = $clonedEntry->id;
            $clonedDocument->save();
        });

        $temporaryPhotos = [];
        $updatedTemporaryPhotos = EstateDocument::where('estate_id', $clonedEntry->id)->get();

        foreach ($updatedTemporaryPhotos as $updatedTemporaryPhoto) {
            $temporaryPhotos[] = 'estate/photos/' . $updatedTemporaryPhoto->path;
        }


        $fileService = new FileService();

        $fileService->copyDirectory('estate/photos/'.$currentEntry->id, 'estate/photos/'.$clonedEntry->id);

        $clonedEntry->unsetEventDispatcher();
        $updatedMainPath = preg_replace('/^[^\/]+/', $clonedEntry->id, $currentEntry->main_image_file_path);
        $updatedMainPathThumb = preg_replace('/^[^\/]+/', $clonedEntry->id, $currentEntry->main_image_file_path);

        $clonedEntry->main_image_file_path = $updatedMainPath;
        $clonedEntry->main_image_file_path_thumb = $updatedMainPathThumb;
        $clonedEntry->temporary_photos = json_encode($temporaryPhotos);
        $clonedEntry->price_usd = (int)((int)$clonedEntry->price_amd / 387);
        $clonedEntry->saveQuietly();

        return (string) $clonedEntry->push();
    }

}

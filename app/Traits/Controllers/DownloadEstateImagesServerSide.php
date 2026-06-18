<?php

namespace App\Traits\Controllers;

use App\Models\EstateDocument;
use App\Services\FileService;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

trait DownloadEstateImagesServerSide
{
    public function downloadEstateImagesServerSide()
    {

        $estate = $this->crud->getCurrentEntry();
        $directory = $estate->id;
        // Create a temporary directory to store downloaded files
        $tempDir = storage_path('temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // List files in the S3 directory
        $zipFileName = $directory . '.zip';
        $publicDir = public_path();

        $files = Storage::disk('S3')->files('/estate/photos/' . $directory);


        $zip = new ZipArchive;
        $zip->open($publicDir . '/downloads/' . $zipFileName, ZipArchive::CREATE);

        foreach ($files as $file) {
            $fileContent = Storage::disk('S3')->get($file);
            $zip->addFromString(basename($file), $fileContent);
        }

        $zip->close();
        $zipFileUrl = url('downloads/'.$zipFileName);

        return response()->json(['zipFileUrl' => $zipFileUrl, 'zipName' => $estate->code]);

    }

}

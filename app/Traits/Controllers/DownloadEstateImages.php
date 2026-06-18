<?php

namespace App\Traits\Controllers;

use App\Models\EstateDocument;
use App\Services\FileService;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;

trait DownloadEstateImages
{
    public function downloadEstateImages()
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

        $files = Storage::disk('S3')->allFiles('/estate/photos/' . $directory);

        // Prepare an array to hold file data with signed URLs
        $filesWithSignedUrls = [];

        // Generate signed URLs for each file
        foreach ($files as $file) {
            $signedUrl = Storage::disk('S3')->temporaryUrl(
                $file,
                now()->addMinutes(15) // Specify the expiration time (e.g., 15 minutes)
            );

            $filesWithSignedUrls[] = [
                'name' => basename($file),
                'url' => $signedUrl,
            ];
        }


        return response()->json($filesWithSignedUrls);

    }

}

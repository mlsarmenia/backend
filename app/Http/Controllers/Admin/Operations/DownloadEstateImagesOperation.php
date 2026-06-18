<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

trait DownloadEstateImagesOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupDownloadEstateImagesRoutes($segment, $routeName, $controller)
    {
        Route::post($segment.'/{id}/download-estate-images', [
            'as'        => $routeName.'.downloadEstateImages',
            'uses'      => $controller.'@downloadEstateImages',
            'operation' => 'downloadEstateImages',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupDownloadEstateImagesDefaults()
    {

        CRUD::allowAccess('downloadEstateImages');

        CRUD::operation('downloadEstateImages', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('show', function () {
             CRUD::addButton('top', 'download_estate_images', 'view', 'crud::buttons.download_estate_images');
             CRUD::addButton('line', 'download_estate_images', 'view', 'crud::buttons.download_estate_images');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
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

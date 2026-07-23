<?php

namespace App\Services;

use App\Models\Estate;

class EstateMainImageService
{
    public function applyDeferredSelection(Estate $estate, array $photos, mixed $selectedPhoto): bool
    {
        if (! is_string($selectedPhoto) || ! in_array($selectedPhoto, $photos, true)) {
            return false;
        }

        $filename = basename($selectedPhoto);

        if ($filename === '') {
            return false;
        }

        $estate->main_image_file_name = $filename;
        $estate->main_image_file_path = $estate->id.'/'.$filename;
        $estate->main_image_file_path_thumb = $estate->id.'/'.$filename;

        return true;
    }
}

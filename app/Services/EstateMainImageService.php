<?php

namespace App\Services;

use App\Models\Estate;

class EstateMainImageService
{
    public function applyDeferredSelection(Estate $estate, array $photos, mixed $selectedPhoto): bool
    {
        if (! is_string($selectedPhoto)) {
            return false;
        }

        $filename = basename($selectedPhoto);

        $submittedFilenames = array_map(
            static fn (mixed $photo): ?string => is_string($photo) ? basename($photo) : null,
            $photos
        );

        if ($filename === '' || ! in_array($filename, $submittedFilenames, true)) {
            return false;
        }

        $estate->main_image_file_name = $filename;
        $estate->main_image_file_path = $estate->id.'/'.$filename;
        $estate->main_image_file_path_thumb = $estate->id.'/'.$filename;

        return true;
    }
}

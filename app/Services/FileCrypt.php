<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileCrypt
{
    /**
     * Converts the given path into a filepond server id
     *
     * @param  string $path
     *
     * @return string
     */
    public function getServerIdFromPath($path)
    {
        return Crypt::encryptString($path);
    }

    /**
     * Converts the given filepond server id into a path
     *
     * @param  string $serverId
     *
     * @return string
     */
    public function getPathFromServerId($serverId)
    {
//        if (! trim($serverId)) {
//            throw new InvalidPathException();
//        }

        $filePath = Crypt::decryptString($serverId);
        //TODO: make deal with non-temporary files
//        if (! Str::startsWith($filePath, config('files.temporary_files_path', 'temporary_files'))) {
//            throw new InvalidPathException();
//        }

        return $filePath;
    }
}

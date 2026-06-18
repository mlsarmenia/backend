<?php

namespace App\Services;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    /**
     * @var string|Repository|Application|mixed
     * @description Can change value and set other disk
     */
    public string $disk;
    public string $temporary_disk;

    public function __construct()
    {
        $this->disk = 'S3';
        $this->temporary_disk = 'S3';
    }

    private function getDisk()
    {
        return $this->disk;
    }

    private function getTemporaryDisk()
    {
        return $this->temporary_disk;
    }

    /**
     * @param string $path
     * @param array $files
     * @return array
     */
    public function moveMultipleFiles(string $finalPath, array $files): array
    {
        $filesData = [];
        foreach ($files as $key => $file) {
            $fileCrypt = new FileCrypt();
            $path = $fileCrypt->getPathFromServerId($file);
            $filePath = Storage::disk($this->temporary_disk)->path($path);
            $fileExtension = File::extension($filePath);
            $fileOriginalName = File::basename($filePath);
            $fileName = Str::uuid().'.'.$fileExtension;
            $finalLocation = $finalPath.'/'.$fileName;
            Storage::disk($this->temporary_disk)->move($path, $finalLocation);

            $filesData[$key]['display_name'] = $fileOriginalName;
            $filesData[$key]['name'] = $fileName;
        }

        return $filesData;
    }

    /**
     * @param string $path
     * @param array $files
     * @return array
     */
    public function uploadMultipleFiles(string $path, array $files): array
    {
        $filenames = [];
        foreach ($files as $file) {
            $filename = $file->hashName();
            $file->storeAs($path, $filename, $this->getDisk());
            $filenames[] = $filename;
        }

        return $filenames;
    }

    /**
     * @param string $path
     * @param array $filenames
     * @return void
     */
    public function deleteMultipleFiles(string $path, array $filenames): void
    {
        foreach ($filenames as $filename) {
            $filePath = $path . '/' . $filename;
            Storage::disk($this->getDisk())->delete($filePath);
        }
    }

    /**
     * @param string $path
     * @param int $lifetime
     * @return string
     */
    public function getTemporaryUrl(string $path, int $lifetime = 3000): string
    {
        if (Storage::disk($this->getDisk())->exists($path)) {
            return Storage::disk($this->getDisk())->temporaryUrl($path, now()->addSeconds($lifetime));
        }

        return '';
    }



    public function uploadFile(string $path, mixed $file)
    {
        $filename = $file->hashName();
        $file->storeAs($path, $filename, $this->getDisk());

        return $filename;
    }

    /**
     * @param string $path
     * @return bool
     */
    public function deleteFileFromDisk(string $path): bool
    {
        return Storage::disk($this->getDisk())->delete($path);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function deleteFileFromTemporaryDisk(string $path): bool
    {
        return Storage::disk($this->getTemporaryDisk())->delete($path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFileFromDisk(string $path, string $disk = 'S3'): string
    {
//        if (!empty($path) && Storage::disk($this->getDisk())->exists($path)) {
            return Storage::disk($disk)->url($path);
//        }

        return '';
    }

    /**
     * @param $path
     * @param $content
     * @return bool
     */
    public function uploadPdf($path, $content): bool
    {
        return Storage::disk($this->getDisk())->put($path, $content);
    }

    public function copyDirectory($sourceDir, $destinationDir)
    {

        $files = Storage::disk('S3Public')->allFiles($sourceDir);
        $originalFiles = Storage::disk('S3')->allFiles($sourceDir);

        // Iterate over each file in the source directory
        foreach ($files as $file) {
            $newFilePath = str_replace($sourceDir, $destinationDir, $file);
            Storage::disk('S3Public')->copy($file, $newFilePath);
        }

        //Original files
        foreach ($originalFiles as $file) {
            $newFilePath = str_replace($sourceDir, $destinationDir, $file);
            Storage::disk('S3')->copy($file, $newFilePath);
        }

        return true;
    }

}

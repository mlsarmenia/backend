<?php

namespace App\Console\Commands;

use App\Models\EstateDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CopyEstateImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'estates:copy-images {fromId? : Starting estate ID (optional)} {toId? : Ending estate ID (optional)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy estate images to directories based on estate ID range.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fromId = $this->argument('fromId');
        $toId = $this->argument('toId');

        // Validate and handle optional arguments
        if (isset($fromId) && !is_numeric($fromId)) {
            $this->error('Invalid starting estate ID. Please provide a number.');
            return 1;
        }

        if (isset($toId) && !is_numeric($toId)) {
            $this->error('Invalid ending estate ID. Please provide a number.');
            return 1;
        }

        // Handle case without arguments (copy all images)
        if (empty($fromId) && empty($toId)) {
            $this->info('Copying all estate images...');
            $this->processAllImages();
        } else {
            // Process images within the provided ID range
            $this->info("Copying estate images from ID $fromId to $toId...");
            $this->processImagesInRange($fromId, $toId);
        }

        return 0;
    }

    private function processAllImages()
    {
        $documents = EstateDocument::all();
        foreach ($documents as $document) {
            $this->copyImage($document->estate_id, $document->path);
        }
    }

    private function processImagesInRange($fromId, $toId)
    {
        $documents = EstateDocument::whereBetween('estate_id', [$fromId, $toId])->get();
        foreach ($documents as $document) {
            $this->copyImage($document->estate_id, $document->path);
        }
    }

    private function copyImage($estateId, $filePath)
    {
        $startTime = microtime(true);

        try {
            $fileName = basename($filePath);
            $destinationPath = "estate/photos/" . $estateId . "/" . $fileName;
            $sourcePath = "estate/photos/" . $filePath;

            // Make sure the destination directory exists on both S3Public and S3
            if (!Storage::disk('S3Public')->exists(dirname($destinationPath))) {
                Storage::disk('S3Public')->makeDirectory(dirname($destinationPath));
            }
            if (!Storage::disk('S3')->exists(dirname($destinationPath))) {
                Storage::disk('S3')->makeDirectory(dirname($destinationPath));
            }


            if (!Storage::disk('S3')->exists($destinationPath)) {
                Storage::disk('S3')->copy($sourcePath, $destinationPath);
            } else {
                $this->info("Estate image $estateId exists");
            }
            if (!Storage::disk('S3Public')->exists($destinationPath)) {
                Storage::disk('S3Public')->copy($sourcePath, $destinationPath);
            } else {
                $this->info("Estate image $estateId exists");
            }


            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;
            $this->info("Copied image for estate ID $estateId (Time: " . round($executionTime, 2) . " seconds)");
        } catch (\Exception $e) {
            Log::error("Error copying image for estate ID $estateId: " . $e->getMessage());
        }
    }

}

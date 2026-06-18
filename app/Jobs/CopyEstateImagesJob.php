<?php

namespace App\Jobs;

use App\Models\EstateDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class CopyEstateImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fromId;
    protected $toId;

    public function __construct($fromId, $toId)
    {
        $this->fromId = $fromId;
        $this->toId = $toId;
    }

    public function handle()
    {
        $documents = EstateDocument::whereBetween('estate_id', [$this->fromId, $this->toId])->get();

        foreach ( $documents as $document) {
            try {

                $proceedInRedis = Redis::sismember('processed_estate_documents"', $document->id);
                $existsInRedis = Redis::sismember('document_exists:', $document->id);

                if (!$existsInRedis || !$proceedInRedis) {
                    // Copy the image as per your original command
                    $this->copyImage($document->estate_id, $document->path, $document->id);

                    // Add the document ID to Redis set of processed documents
                    Redis::sadd('processed_estate_documents:', $document->id);
                }



            } catch (\Exception $e) {
                Log::error("Error processing estate document ID $document->id: " . $e->getMessage());
            }
        }
    }


    private function copyImage($estateId, $filePath, $documentId)
    {
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
                Redis::sadd('processed_estate_documents:S3:', $documentId);
            } else {
                Redis::sadd('document_exists:S3:', $documentId);
            }
            if (!Storage::disk('S3Public')->exists($destinationPath)) {
                Storage::disk('S3Public')->copy($sourcePath, $destinationPath);
                Redis::sadd('processed_estate_documents:S3Public:', $documentId);
            } else {
                Redis::sadd('document_exists:S3Public:', $documentId);
            }

        } catch (\Exception $e) {
            Log::error("Error copying image for document $documentId: " . $e->getMessage());
            Redis::sadd('document_error:', $documentId);
        }
    }

}

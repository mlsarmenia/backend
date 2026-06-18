<?php

namespace App\Jobs;

use App\Models\Estate;
use App\Models\EstateDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class UpdateTemporaryPhotosJob implements ShouldQueue
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

        $fromId = $this->fromId;
        $toId = $this->toId;

        // Fetch estates within the specified range along with their associated documents
        $estates = Estate::with('estateDocuments')
            ->whereBetween('id', [$fromId, $toId])
            ->get();

        foreach ($estates as $estate) {

            $documents = EstateDocument::where('estate_id', $estate->id)->get();



            $filenames = $documents->map(function ($document) {
                return 'estate/photos/'.$document->estate_id.'/'. basename($document->path);
            })->toArray();




            // Update temporary_photos column for the current estate
            $estate->update([
                'temporary_photos' => json_encode(
                    $filenames
                )
            ]);
            $estate->temporary_photos = json_encode( $filenames);
            $estate->save();
        }

    }
}

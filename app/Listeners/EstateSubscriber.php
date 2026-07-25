<?php

namespace App\Listeners;

use App\Events\EstateDocumentUploaded;
use App\Jobs\MoveTemporaryFilesToPermanentDirectory;

class EstateSubscriber
{
    /**
     * Handle Estate file uploaded events.
     */
    public function onEstateDocumentUploaded($event)
    {
        MoveTemporaryFilesToPermanentDirectory::dispatch(
            $event->finalPath,
            $event->files,
            $event->model,
            $event->fileService
        );
    }
    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe($events)
    {
        $events->listen(
            EstateDocumentUploaded::class,
            [EstateSubscriber::class, 'onEstateDocumentUploaded']
        );

    }
}

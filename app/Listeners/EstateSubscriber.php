<?php

namespace App\Listeners;

use App\Events\EstateCreated;
use App\Events\EstateDocumentUploaded;
use App\Jobs\MoveTemporaryFilesToPermanentDirectory;
use stdClass;

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
            EstateCreated::class,
            [EstateSubscriber::class, 'onEstateCreated']
        );

        $events->listen(
            EstateDocumentUploaded::class,
            [EstateSubscriber::class, 'onEstateDocumentUploaded']
        );

    }
}

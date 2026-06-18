<?php

namespace App\Events;

use App\Services\FileService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EstateDocumentUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $finalPath;
    public array $files;
    public mixed $model;
    public FileService $fileService;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        string $finalPath,
        array $files,
        mixed $model,
        FileService $fileService
    ) {
        $this->finalPath = $finalPath;
        $this->files = $files;
        $this->model = $model;
        $this->fileService = $fileService;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

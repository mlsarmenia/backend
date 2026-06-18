<?php

namespace App\Jobs;

use App\Services\FileService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MoveTemporaryFilesToPermanentDirectory implements ShouldQueue
{
    use Dispatchable;
//        use InteractsWithQueue, Queueable, SerializesModels;

    private string $finalPath;
    private array $files;
    private mixed $model;
    private FileService $fileService;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filesData = $this->fileService->moveMultipleFiles($this->finalPath, $this->files);
        $this->model->files()->createMany($filesData);
    }
}

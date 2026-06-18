<?php

// app/Console/Commands/RunBatchCommands.php

namespace App\Console\Commands;

use App\Jobs\CopyEstateImagesJob;
use App\Jobs\UpdateTemporaryPhotosJob;
use Illuminate\Console\Command;

class RunBatchCommands extends Command
{
    protected $signature = 'run:batch-commands  {fromId?} {toId?}';

    protected $description = 'Run the run:batch-commands command in batches.';

    public function handle()
    {
        $fromId = $this->argument('fromId') ?? 1;
        $toId = $this->argument('toId') ?? 100;

        // Divide the range into batches
        $batchSize = 100;
        for ($currentId = $fromId; $currentId <= $toId; $currentId += $batchSize) {
            $batchFromId = $currentId;
            $batchToId = min($currentId + $batchSize - 1, $toId);

            // Dispatch a job for each batch
//            CopyEstateImagesJob::dispatch($batchFromId, $batchToId);
            UpdateTemporaryPhotosJob::dispatch($batchFromId, $batchToId);
        }
    }
}

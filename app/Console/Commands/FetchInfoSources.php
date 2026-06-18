<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FetchInfoSources as FetchInfoSourcesJob;

class FetchInfoSources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'info-sources:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $job = new FetchInfoSourcesJob();
        $job->handle();
    }
}

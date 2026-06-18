<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FetchProjects as FetchProjectsJob;

class FetchProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch projects';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $job = new FetchProjectsJob();
        $job->handle();
    }
}

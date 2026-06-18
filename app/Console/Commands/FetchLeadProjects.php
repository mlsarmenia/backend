<?php

namespace App\Console\Commands;

use App\Jobs\FetchLeadProjects as FetchLeadProjectsJob;
use Illuminate\Console\Command;

class FetchLeadProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lead-projects:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch available projects to be assigned to B24 leads';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $job = new FetchLeadProjectsJob();
        $job->handle();
    }
}

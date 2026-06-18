<?php

namespace App\Console\Commands;

use App\Jobs\FetchContactProjects as FetchContactProjectsJob;
use Illuminate\Console\Command;

class FetchContactProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact-projects:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch available projects to be assigned to B24 contacts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $job = new FetchContactProjectsJob();
        $job->handle();
    }
}

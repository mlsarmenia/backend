<?php

namespace App\Console\Commands;

use App\Jobs\FetchLeads as FetchContactsJob;
use Illuminate\Console\Command;

class FetchLeads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leads:fetch {--offset=} {--id=*}';

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
        $offset = $this->option('offset');
        $id = $this->option('id');
        $job = new FetchContactsJob($id, $offset);
        $job->handle();
    }
}

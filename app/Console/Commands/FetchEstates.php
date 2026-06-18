<?php

namespace App\Console\Commands;


use App\Jobs\FetchEstates as FetchEstatesJob;
use Illuminate\Console\Command;

class FetchEstates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'estates:fetch {--offset=} {--id=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch estates from Bitrix24';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $offset = $this->option('offset');
        $id = $this->option('id');
        $job = new FetchEstatesJob($id, $offset);
        $job->handle();
    }
}

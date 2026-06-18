<?php

namespace App\Console\Commands;

use App\Jobs\FetchDeals as FetchDealsJob;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Illuminate\Console\Command;

class FetchDeals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deals:fetch {--offset=} {--id=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws BaseException
     */
    public function handle(): void
    {
        $offset = $this->option('offset');
        $id = $this->option('id');
        $job = new FetchDealsJob($id, $offset);
        $job->handle();
    }
}

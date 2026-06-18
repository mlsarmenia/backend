<?php

namespace App\Console\Commands;

use App\Services\GeocodingService;
use Illuminate\Console\Command;

class ReverseGeocode extends Command
{
    protected $signature = 'reverse-geocode:estates {start_id} {end_id}';
    protected $description = 'Reverse geocode estates within a range of IDs';

    protected GeocodingService $geocodingService;

    public function __construct(GeocodingService $geocodingService)
    {
        parent::__construct();
        $this->geocodingService = $geocodingService;
    }

    public function handle()
    {
        $start = now();
        $this->comment('Processing');

        $startId = $this->argument('start_id');
        $endId = $this->argument('end_id');

        $estatesCount = $this->geocodingService->getEstateCoordinates($startId, $endId);

        $this->info("Proceed count: $estatesCount");


        $time = $start->diffInSeconds(now());
        $this->comment("Processed in $time seconds");
    }
}

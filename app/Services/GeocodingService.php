<?php

namespace App\Services;

use App\Models\Estate;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use http\Exception;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\GuzzleRateLimiterMiddleware\RateLimiterMiddleware;

class GeocodingService
{
    protected $googleMapsApiKey;

    public function __construct()
    {
        $this->googleMapsApiKey = config('services.map.api_key');
    }

    public function getEstateCoordinates($startId, $endId)
    {

        Log::info('started geocode');
        // Get estates with the given conditions
        $estates = Estate::where('estate_status_id', '>=', 2)
            ->whereIn('estate_status_id', [2, 3, 4])
            ->where('estate_latitude', '=', 0)
            ->where('estate_longitude', '=', 0)
            ->whereBetween('id', [$startId, $endId])
            ->get();

        $processedIds = [];

        $stack = HandlerStack::create();
        $stack->push(RateLimiterMiddleware::perSecond(40));

        $httpClient = new Client([
            'handler' => $stack,
        ]);


        foreach ($estates as $estate) {
            $address = $estate->full_address;


            try {
                $response = $httpClient->get('https://maps.googleapis.com/maps/api/geocode/json', [
                    'query' => [
                        'address' => $address,
                        'key' => $this->googleMapsApiKey
                    ],
                ]);

                $result = $response->getBody()->getContents();
                $result = json_decode($result);

                if (isset($result->results[0])) {
                    $location = $result->results[0]->geometry->location;
                    $estate->estate_latitude = $location->lat;
                    $estate->estate_longitude = $location->lng;

                    $estate->save();
                    $processedIds[] = $estate->id;
                }
            } catch (Exception $e) {
                Log::error('Estate proceed failed id - '.$estate->id) ;
                Log::error('Estate proceed failed id - '.$e->getMessage()) ;
            }
        }

        return count($processedIds);
    }
}

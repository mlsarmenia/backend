<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Estate;
use Illuminate\Database\Eloquent\Builder;

class PotentialEstateMatcher
{
    public const ELIGIBLE_ESTATE_STATUS_IDS = [1, 2, 3, 4];

    public function forClient(Client $client): Builder
    {
        $query = Estate::query()
            ->whereIn('estate_status_id', self::ELIGIBLE_ESTATE_STATUS_IDS)
            ->orderByDesc('created_at');

        if ($client->estate_type_id !== null) {
            $query->where('estate_type_id', $client->estate_type_id);
        }

        if ($client->estate_contract_type_id !== null) {
            $query->where('contract_type_id', $client->estate_contract_type_id);
        }

        if ($client->area_from !== null) {
            $query->where('area_total', '>=', $client->area_from);
        }

        if ($client->area_to !== null) {
            $query->where('area_total', '<=', $client->area_to);
        }

        if ($client->location_province_id !== null) {
            $query->where('location_province_id', $client->location_province_id);
        }

        if ($client->location_city_id !== null) {
            $query->where(function (Builder $subQuery) use ($client) {
                $subQuery->whereNull('location_city_id')
                    ->orWhere('location_city_id', $client->location_city_id);
            });
        }

        $communityIds = $client->communities->modelKeys();

        if ($communityIds !== []) {
            $query->whereIn('location_community_id', $communityIds);
        }

        if ($client->price_from_amd !== null) {
            $query->where('price_amd', '>=', $client->price_from_amd);
        }

        if ($client->price_to_amd !== null) {
            $query->where('price_amd', '<=', $client->price_to_amd);
        }

        if ($client->room_count_from !== null) {
            $query->where('room_count', '>=', $client->room_count_from);
        }

        if ($client->room_count_to !== null) {
            $query->where('room_count', '<=', $client->room_count_to);
        }

        $repairingTypeIds = $client->client_repairing_types->modelKeys();

        if ($repairingTypeIds !== []) {
            $query->whereIn('repairing_type_id', $repairingTypeIds);
        }

        $buildingProjectTypeIds = $client->client_building_project__types->modelKeys();

        if ($buildingProjectTypeIds !== []) {
            $query->whereIn('building_project_type_id', $buildingProjectTypeIds);
        }

        $buildingTypeIds = $client->client_building_types->modelKeys();

        if ($buildingTypeIds !== []) {
            $query->whereIn('building_type_id', $buildingTypeIds);
        }

        return $query;
    }
}

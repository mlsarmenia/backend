<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Estate;
use Illuminate\Database\Eloquent\Builder;

class PotentialClientMatcher
{
    public const ELIGIBLE_STATUS_IDS = [1, 3];

    public function forEstate(Estate $estate): Builder
    {
        return Contact::query()
            ->whereIn('contact_type_id', [4, 5])
            ->with('client')
            ->whereHas('client', function (Builder $query) use ($estate) {
                $query->whereIn('contact_status_id', self::ELIGIBLE_STATUS_IDS);

                if ($estate->estate_type_id) {
                    $query->where('estate_type_id', $estate->estate_type_id);
                }

                if ($estate->contract_type_id) {
                    $query->where('estate_contract_type_id', $estate->contract_type_id);
                }

                if ($estate->area_total) {
                    $query->where(function (Builder $subQuery) use ($estate) {
                        $subQuery->where('area_from', '<=', $estate->area_total)
                            ->where('area_to', '>=', $estate->area_total);
                    });
                }

                if ($estate->location_province_id) {
                    $query->where('location_province_id', $estate->location_province_id);
                }

                if ($estate->location_city_id) {
                    $query->where('location_city_id', $estate->location_city_id);
                }

                if ($estate->location_community_id) {
                    $query->whereHas('communities', function (Builder $subQuery) use ($estate) {
                        $subQuery->where('client_community.community_id', $estate->location_community_id);
                    });
                }

                if ($estate->price_amd) {
                    $query->where(function (Builder $subQuery) use ($estate) {
                        $subQuery->where('price_from_amd', '<=', $estate->price_amd)
                            ->where('price_to_amd', '>=', $estate->price_amd);
                    });
                }

                if ($estate->room_count) {
                    $query->where(function (Builder $subQuery) use ($estate) {
                        $subQuery->where('room_count_from', '<=', $estate->room_count)
                            ->where('room_count_to', '>=', $estate->room_count);
                    });
                }

                if ($estate->repairing_type_id) {
                    $query->whereHas('client_repairing_types', function (Builder $subQuery) use ($estate) {
                        $subQuery->where(
                            'client_repairing_type.repairing_type_id',
                            $estate->repairing_type_id
                        );
                    });
                }

                if ($estate->building_project_type_id) {
                    $query->whereHas('client_building_project__types', function (Builder $subQuery) use ($estate) {
                        $subQuery->where(
                            'client_building_project_type.building_project_type_id',
                            $estate->building_project_type_id
                        );
                    });
                }

                if ($estate->building_type_id) {
                    $query->whereHas('client_building_types', function (Builder $subQuery) use ($estate) {
                        $subQuery->where(
                            'client_building_type.building_type_id',
                            $estate->building_type_id
                        );
                    });
                }
            });
    }
}

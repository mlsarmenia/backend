<?php


namespace App\Models;

use App\Models\Scopes\SecondaryMarketScope;
use App\Scopes\EstateScope;
use App\Services\CurrencyRateService;
use App\Traits\ApiMultiLanguage;
use App\Traits\Models\HasFilePath;
use App\Traits\Models\LogsActivity;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;

/**
 * Class EstateResource
 *
 * @property int $id
 * @property int|null $location_country_id
 * @property int|null $location_province_id
 * @property int|null $location_city_id
 * @property int|null $location_community_id
 * @property int|null $location_street_id
 * @property int|null $estate_type_id
 * @property float|null $area_total
 * @property float|null $old_price
 * @property float|null $price
 * @property int|null $currency_id
 * @property int|null $seller_id
 * @property float|null $area_residential
 * @property int|null $registered_right_id
 * @property int|null $repairing_type_id
 * @property int|null $room_count
 * @property int|null $building_type_id
 * @property int|null $building_project_type_id
 * @property bool|null $conditioner
 * @property int|null $room_count_modified
 * @property int|null $exterior_design_type_id
 * @property int|null $elevator_type_id
 * @property int|null $year_id
 * @property int|null $heating_system_type_id
 * @property int|null $parking_type_id
 * @property int|null $service_fee_type_id
 * @property float|null $service_amount
 * @property int|null $service_amount_currency_id
 * @property bool|null $furniture
 * @property bool|null $kitchen_furniture
 * @property bool|null $gas_heater
 * @property bool|null $persistent_water
 * @property bool|null $natural_gas
 * @property bool|null $gas_possibility
 * @property bool|null $internet
 * @property bool|null $satellite_tv
 * @property bool|null $cable_tv
 * @property bool|null $sunny
 * @property bool|null $exclusive_design
 * @property bool|null $expanding_possible
 * @property bool|null $open_balcony
 * @property bool|null $oriel
 * @property bool|null $new_wiring
 * @property bool|null $new_water_tubes
 * @property bool|null $heating_ground
 * @property bool|null $plastic_windows
 * @property bool|null $parquet
 * @property bool|null $laminat
 * @property bool|null $equipped
 * @property int|null $roof_type_id
 * @property int|null $floor_count_id
 * @property int|null $house_building_type_id
 * @property bool|null $roof_repaired
 * @property int|null $roof_material_type_id
 * @property int|null $fence_type_id
 * @property int|null $communication_type_id
 * @property int|null $front_with_street_id
 * @property int|null $road_way_type_id
 * @property int|null $commercial_purpose_type_id
 * @property int|null $communication_id
 * @property int|null $land_structure_type_id
 * @property int|null $land_type_id
 * @property int|null $land_use_type_id
 * @property float|null $front_length
 * @property int|null $version
 * @property string|null $address_building
 * @property string|null $address_apartment
 * @property int|null $contract_type_id
 * @property int|null $entrance_door_type_id
 * @property int|null $entrance_door_position_id
 * @property int|null $windows_view_id
 * @property int|null $building_floor_count
 * @property int|null $house_floors_type_id
 * @property bool|null $roof_drainage
 * @property bool|null $new_doors
 * @property bool|null $new_windows
 * @property bool|null $new_bathroom
 * @property bool|null $new_floor
 * @property bool|null $new_roof
 * @property bool|null $can_be_used_as_commercial
 * @property bool|null $is_published
 * @property int|null $estate_status_id
 * @property Carbon|null $status_changed_on
 * @property int|null $status_id_before_archive
 * @property int|null $buyer_id
 * @property int|null $agent_id
 * @property float|null $selling_price_init
 * @property float|null $selling_price_final
 * @property int|null $selling_price_final_currency_id
 * @property int|null $selling_price_init_currency_id
 * @property Carbon|null $created_on
 * @property bool|null $new_construction
 * @property int|null $floor
 * @property string|null $comment_arm
 * @property string|null $comment_eng
 * @property string|null $comment_ru
 * @property int|null $last_modified_by
 * @property string|null $additional_info_arm
 * @property string|null $additional_info_eng
 * @property string|null $additional_info_ru
 * @property string|null $name_arm
 * @property string|null $name_eng
 * @property string|null $name_ru
 * @property string|null $name_ar
 * @property string|null $selling_comment_arm
 * @property string|null $selling_comment_eng
 * @property string|null $selling_comment_ru
 * @property Carbon|null $last_modified_on
 * @property int|null $created_by
 * @property bool|null $garage
 * @property bool|null $cellar
 * @property bool|null $land
 * @property bool|null $niche
 * @property bool|null $pantry
 * @property bool|null $jacuzzi
 * @property bool|null $possible_extension
 * @property bool|null $separate_room
 * @property bool|null $exchange
 * @property bool|null $has_intercom
 * @property bool|null $uninhabited
 * @property bool|null $balcony
 * @property bool|null $tv
 * @property bool|null $computer
 * @property bool|null $refrigirator
 * @property bool|null $hot_water
 * @property bool|null $washer
 * @property bool|null $dish_washer
 * @property int|null $property_agent_id
 * @property string|null $code
 * @property Carbon|null $appointment_date_start
 * @property Carbon|null $appointment_date_end
 * @property string|null $appointment_comment_arm
 * @property string|null $appointment_comment_eng
 * @property string|null $appointment_comment_ru
 * @property int|null $ceiling_height_type_id
 * @property int|null $building_structure_type_id
 * @property int|null $building_floor_type_id
 * @property int|null $vitrage_type_id
 * @property int|null $separate_entrance_type_id
 * @property string|null $intercom
 * @property int|null $filled_by
 * @property Carbon|null $filled_on
 * @property int|null $verified_by
 * @property Carbon|null $verified_on
 * @property int|null $entrance_type_id
 * @property bool|null $has_neighbour
 * @property bool|null $is_advertised
 * @property int|null $info_source_id
 * @property float|null $price_usd
 * @property Carbon|null $archive_till_date
 * @property string|null $archive_comment_arm
 * @property string|null $archive_comment_eng
 * @property string|null $archive_comment_ru
 * @property string|null $public_text_arm
 * @property string|null $public_text_eng
 * @property string|null $public_text_rus
 * @property float|null $estate_latitude
 * @property float|null $estate_longitude
 * @property bool|null $is_urgent
 * @property Carbon|null $urgent_start_date
 * @property bool|null $is_exchangeable
 * @property bool|null $is_first_floor
 * @property bool|null $is_last_floor
 * @property string|null $main_image_file_name
 * @property string|null $main_image_file_path
 * @property string|null $main_image_file_path_thumb
 * @property bool|null $is_mansard_floor
 * @property bool|null $is_duplex
 * @property bool|null $is_basement
 * @property int|null $visits_count
 * @property bool|null $is_from_public
 * @property bool|null $is_hot_offer
 * @property Carbon|null $hot_offer_start_date
 * @property bool|null $is_on_main_page
 * @property Carbon|null $on_main_page_start_date
 * @property bool|null $is_separate_building
 * @property bool|null $is_estate_commercial_land
 * @property int|null $courtyard_improvement_id
 * @property int|null $distance_public_objects_id
 * @property int|null $building_window_count_id
 * @property int|null $temporary_agent_id
 * @property Carbon|null $temporary_agent_date
 * @property int|null $temporary_visits_count
 * @property bool|null $apartment_construction
 * @property string|null $meta_description_eng
 * @property string|null $meta_description_arm
 * @property string|null $meta_description_ru
 * @property string|null $meta_title_eng
 * @property string|null $meta_title_arm
 * @property string|null $meta_title_ru
 * @property Carbon|null $price_down_on
 * @property bool|null $is_public_text_generation
 *
 * @property CBuildingType|null $c_building_type
 * @property CElevatorType|null $c_elevator_type
 * @property CHeatingSystemType|null $c_heating_system_type
 * @property CParkingType|null $c_parking_type
 * @property CRepairingType|null $c_repairing_type
 * @property CServiceFeeType|null $c_service_fee_type
 * @property CYear|null $c_year
 * @property Contact|null $contact
 * @property CCurrency|null $c_currency
 * @property CEstateType|null $c_estate_type
 * @property CLocationCity|null $c_location_city
 * @property CLocationCommunity|null $c_location_community
 * @property CLocationCountry|null $c_location_country
 * @property CLocationProvince|null $c_location_province
 * @property CLocationStreet|null $c_location_street
 * @property CRegisteredRight|null $c_registered_right
 * @property CCommunicationType|null $c_communication_type
 * @property CExteriorDesignType|null $c_exterior_design_type
 * @property CFenceType|null $c_fence_type
 * @property CFrontWithStreet|null $c_front_with_street
 * @property CHouseBuildingType|null $c_house_building_type
 * @property CRoadWayType|null $c_road_way_type
 * @property CRoofMaterialType|null $c_roof_material_type
 * @property CRoofType|null $c_roof_type
 * @property CLandStructureType|null $c_land_structure_type
 * @property EstateOptionType|null $c_land_type
 *
 * @package App\Models
 */
class Estate extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use ApiMultiLanguage;
    use HasFilePath;
    use LogsActivity;

    protected $table = 'estate';
    public $incrementing = true;

    protected $casts = [
        'id' => 'integer',
        'location_country_id' => 'integer',
        'location_province_id' => 'integer',
        'location_city_id' => 'integer',
        'location_community_id' => 'integer',
        'location_street_id' => 'integer',
        'estate_type_id' => 'integer',
        'is_company_project' => 'boolean',
        'area_total' => 'float',
        'old_price' => 'float',
        'price' => 'float',
        'currency_id' => 'integer',
        'seller_id' => 'integer',
        'area_residential' => 'float',
        'registered_right_id' => 'integer',
        'repairing_type_id' => 'integer',
        'room_count' => 'integer',
        'building_type_id' => 'integer',
        'building_project_type_id' => 'integer',
        'conditioner' => 'bool',
        'room_count_modified' => 'integer',
        'exterior_design_type_id' => 'integer',
        'elevator_type_id' => 'integer',
        'year_id' => 'integer',
        'heating_system_type_id' => 'integer',
        'parking_type_id' => 'integer',
        'service_fee_type_id' => 'integer',
        'service_amount' => 'float',
        'service_amount_currency_id' => 'integer',
        'furniture' => 'bool',
        'kitchen_furniture' => 'bool',
        'gas_heater' => 'bool',
        'persistent_water' => 'bool',
        'natural_gas' => 'bool',
        'gas_possibility' => 'bool',
        'internet' => 'bool',
        'satellite_tv' => 'bool',
        'cable_tv' => 'bool',
        'sunny' => 'bool',
        'exclusive_design' => 'bool',
        'expanding_possible' => 'bool',
        'open_balcony' => 'bool',
        'oriel' => 'bool',
        'new_wiring' => 'bool',
        'new_water_tubes' => 'bool',
        'heating_ground' => 'bool',
        'plastic_windows' => 'bool',
        'parquet' => 'bool',
        'laminat' => 'bool',
        'equipped' => 'bool',
        'roof_type_id' => 'integer',
        'floor_count_id' => 'integer',
        'house_building_type_id' => 'integer',
        'roof_repaired' => 'bool',
        'roof_material_type_id' => 'integer',
        'fence_type_id' => 'integer',
        'communication_type_id' => 'integer',
        'front_with_street_id' => 'integer',
        'road_way_type_id' => 'integer',
        'commercial_purpose_type_id' => 'integer',
        'communication_id' => 'integer',
        'land_structure_type_id' => 'integer',
        'land_type_id' => 'integer',
        'land_use_type_id' => 'integer',
        'front_length' => 'float',
        'version' => 'integer',
        'contract_type_id' => 'integer',
        'entrance_door_type_id' => 'integer',
        'entrance_door_position_id' => 'integer',
        'windows_view_id' => 'integer',
        'building_floor_count' => 'integer',
        'house_floors_type_id' => 'integer',
        'roof_drainage' => 'bool',
        'new_doors' => 'bool',
        'new_windows' => 'bool',
        'new_bathroom' => 'bool',
        'new_floor' => 'bool',
        'new_roof' => 'bool',
        'can_be_used_as_commercial' => 'bool',
        'is_published' => 'bool',
        'estate_status_id' => 'integer',
        'status_id_before_archive' => 'integer',
        'buyer_id' => 'integer',
        'agent_id' => 'integer',
        'selling_price_init' => 'float',
        'selling_price_final' => 'float',
        'selling_price_final_currency_id' => 'integer',
        'selling_price_init_currency_id' => 'integer',
        'new_construction' => 'bool',
        'floor' => 'integer',
        'last_modified_by' => 'integer',
        'created_by' => 'integer',
        'garage' => 'bool',
        'cellar' => 'bool',
        'land' => 'bool',
        'niche' => 'bool',
        'pantry' => 'bool',
        'jacuzzi' => 'bool',
        'possible_extension' => 'bool',
        'separate_room' => 'bool',
        'exchange' => 'bool',
        'has_intercom' => 'bool',
        'uninhabited' => 'bool',
        'balcony' => 'bool',
        'tv' => 'bool',
        'computer' => 'bool',
        'refrigirator' => 'bool',
        'hot_water' => 'bool',
        'washer' => 'bool',
        'dish_washer' => 'bool',
        'property_agent_id' => 'integer',
        'ceiling_height_type_id' => 'integer',
        'building_structure_type_id' => 'integer',
        'building_floor_type_id' => 'integer',
        'vitrage_type_id' => 'integer',
        'separate_entrance_type_id' => 'integer',
        'filled_by' => 'integer',
        'verified_by' => 'integer',
        'entrance_type_id' => 'integer',
        'has_neighbour' => 'bool',
        'is_advertised' => 'bool',
        'info_source_id' => 'integer',
        'price_usd' => 'float',
        'estate_latitude' => 'float',
        'estate_longitude' => 'float',
        'is_urgent' => 'bool',
        'is_exchangeable' => 'bool',
        'is_first_floor' => 'bool',
        'is_last_floor' => 'bool',
        'is_mansard_floor' => 'bool',
        'is_duplex' => 'bool',
        'is_basement' => 'bool',
        'visits_count' => 'integer',
        'is_from_public' => 'bool',
        'is_hot_offer' => 'bool',
        'is_on_main_page' => 'bool',
        'is_separate_building' => 'bool',
        'is_estate_commercial_land' => 'bool',
        'courtyard_improvement_id' => 'integer',
        'distance_public_objects_id' => 'integer',
        'building_window_count_id' => 'integer',
        'temporary_agent_id' => 'integer',
        'temporary_visits_count' => 'integer',
        'apartment_construction' => 'bool',
        'is_public_text_generation' => 'bool'
    ];

    protected $dates = [
        'status_changed_on',
        'created_on',
        'last_modified_on',
        'appointment_date_start',
        'appointment_date_end',
        'filled_on',
        'verified_on',
        'archive_till_date',
        'urgent_start_date',
        'hot_offer_start_date',
        'on_main_page_start_date',
        'temporary_agent_date',
        'price_down_on'
    ];

    protected $fillable = [
        'location_country_id',
        'location_province_id',
        'location_city_id',
        'location_community_id',
        'location_street_id',
        'estate_type_id',
        'market_type',
        'is_company_project',
        'b24_project_id',
        'b24_product_id',
        'apartment_code',
        'primary_market_product_id',
        'area_total',
        'old_price',
        'price',
        'currency_id',
        'seller_id',
        'area_residential',
        'registered_right_id',
        'repairing_type_id',
        'room_count',
        'building_type_id',
        'building_project_type_id',
        'conditioner',
        'room_count_modified',
        'exterior_design_type_id',
        'elevator_type_id',
        'year_id',
        'heating_system_type_id',
        'parking_type_id',
        'service_fee_type_id',
        'service_amount',
        'service_amount_currency_id',
        'furniture',
        'kitchen_furniture',
        'gas_heater',
        'persistent_water',
        'natural_gas',
        'gas_possibility',
        'internet',
        'satellite_tv',
        'cable_tv',
        'sunny',
        'exclusive_design',
        'expanding_possible',
        'open_balcony',
        'oriel',
        'new_wiring',
        'new_water_tubes',
        'heating_ground',
        'plastic_windows',
        'parquet',
        'laminat',
        'equipped',
        'roof_type_id',
        'floor_count_id',
        'house_building_type_id',
        'roof_repaired',
        'roof_material_type_id',
        'fence_type_id',
        'communication_type_id',
        'front_with_street_id',
        'road_way_type_id',
        'commercial_purpose_type_id',
        'communication_id',
        'land_structure_type_id',
        'land_type_id',
        'land_use_type_id',
        'front_length',
        'version',
        'address_building',
        'address_apartment',
        'contract_type_id',
        'entrance_door_type_id',
        'entrance_door_position_id',
        'windows_view_id',
        'building_floor_count',
        'house_floors_type_id',
        'roof_drainage',
        'new_doors',
        'new_windows',
        'new_bathroom',
        'new_floor',
        'new_roof',
        'can_be_used_as_commercial',
        'is_published',
        'estate_status_id',
        'status_changed_on',
        'status_id_before_archive',
        'buyer_id',
        'agent_id',
        'selling_price_init',
        'selling_price_final',
        'selling_price_final_currency_id',
        'selling_price_init_currency_id',
        'created_on',
        'new_construction',
        'floor',
        'comment_arm',
        'comment_eng',
        'comment_ru',
        'last_modified_by',
        'additional_info_arm',
        'additional_info_eng',
        'additional_info_ru',
        'name_arm',
        'name_eng',
        'name_ru',
        'name_ar',
        'selling_comment_arm',
        'selling_comment_eng',
        'selling_comment_ru',
        'last_modified_on',
        'created_by',
        'garage',
        'cellar',
        'land',
        'niche',
        'pantry',
        'jacuzzi',
        'possible_extension',
        'separate_room',
        'exchange',
        'has_intercom',
        'uninhabited',
        'balcony',
        'tv',
        'computer',
        'refrigirator',
        'hot_water',
        'washer',
        'dish_washer',
        'property_agent_id',
        'code',
        'appointment_date_start',
        'appointment_date_end',
        'appointment_comment_arm',
        'appointment_comment_eng',
        'appointment_comment_ru',
        'ceiling_height_type_id',
        'building_structure_type_id',
        'building_floor_type_id',
        'vitrage_type_id',
        'separate_entrance_type_id',
        'intercom',
        'filled_by',
        'filled_on',
        'verified_by',
        'verified_on',
        'entrance_type_id',
        'has_neighbour',
        'is_advertised',
        'info_source_id',
        'price_usd',
        'price_amd',
        'archive_till_date',
        'archive_comment_arm',
        'archive_comment_eng',
        'archive_comment_ru',
        'public_text_arm',
        'public_text_eng',
        'public_text_rus',
        'estate_latitude',
        'estate_longitude',
        'is_urgent',
        'urgent_start_date',
        'is_exchangeable',
        'is_first_floor',
        'is_last_floor',
        'main_image_file_name',
        'main_image_file_path',
        'main_image_file_path_thumb',
        'is_mansard_floor',
        'is_duplex',
        'is_basement',
        'visits_count',
        'is_from_public',
        'is_hot_offer',
        'hot_offer_start_date',
        'is_on_main_page',
        'on_main_page_start_date',
        'is_separate_building',
        'is_estate_commercial_land',
        'courtyard_improvement_id',
        'distance_public_objects_id',
        'building_window_count_id',
        'temporary_agent_id',
        'temporary_agent_date',
        'temporary_visits_count',
        'apartment_construction',
        'meta_description_eng',
        'meta_description_arm',
        'meta_description_ru',
        'meta_title_eng',
        'meta_title_arm',
        'meta_title_ru',
        'price_down_on',
        'is_public_text_generation',
        'arch_project_package',
        'arch_project',
        'building_permit',
    ];

    protected $appends = ['shortDescription'];

    protected array $multi_lang = [
        'name', 'public_text'
    ];
    /*Apply scopes*/

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new EstateScope());
        static::addGlobalScope(new SecondaryMarketScope());
    }

    public function scopePriceFrom(Builder $query, $price): Builder
    {
        return $query->where('price_amd', '>=', $price);
    }

    public function scopePriceTo(Builder $query, $price): Builder
    {
        return $query->where('price_amd', '<=', $price);
    }

    public function scopeAreaTo(Builder $query, $areaTo): Builder
    {
        return $query->where('area_total', '<=', $areaTo);
    }

    public function scopeAreaFrom(Builder $query, $areaFrom): Builder
    {
        return $query->where('area_total', '>=', $areaFrom);
    }

    public function scopeCoordinates(Builder $query, $coordinates): Builder
    {
        $request_coords = json_decode($coordinates);
        $polygon_coords = '';
        foreach ($request_coords as $coord) {
            $polygon_coords .= $coord[0] . ' ' . $coord[1] . ', ';
        }
        $polygon_coords .= $request_coords[0][0] . ' ' . $request_coords[0][1]; // add first coordinate again to close the polygon


        return $query->whereIn('estate_status_id', [2, 3, 4])->whereRaw("ST_Within(Point(estate_latitude, estate_longitude), ST_PolygonFromText('POLYGON((" . $polygon_coords . "))'))");
    }


//    public function scopeCoordinates(Builder $query, $coordinates): Builder
//    {
//        // Decode the coordinates
//        $request_coords = json_decode($coordinates);
//
//        // Prepare the polygon coordinates
//        $points = [];
//        foreach ($request_coords as $coord) {
//            $points[] = new Point($coord[0], $coord[1]);
//        }
//// Close the polygon by adding the first coordinate at the end
//        $points[] = new Point($request_coords[0][0], $request_coords[0][1]);
//
//// Create the LineString object from the points
//        $lineString = new LineString($points);
//
//// Create the Polygon object using the LineString
//        $polygon = new Polygon([$lineString]);
//// Perform the query
//        return $query->whereIn('estate_status_id', [2, 3, 4])
//            ->whereRaw("ST_Within(location, ST_GeomFromText(?))", [$polygon->toWkt()]);
//    }

    public function scopeTextSearch(Builder $query, $searchText): Builder
    {
        return $query->where('id', '=', $searchText)
            ->orWhere('code', 'like', '%' . $searchText . '%')
            ->orWhereHas('location_city', function ($query) use ($searchText) {
                $query->where('name_arm', 'LIKE', '%' . $searchText . '%');
            })
            ->orWhereHas('location_street', function ($query) use ($searchText) {
                $query->where('name_arm', 'LIKE', '%' . $searchText . '%');
            })
            ->orWhereHas('location_community', function ($query) use ($searchText) {
                $query->where('name_arm', 'LIKE', '%' . $searchText . '%');
            });
    }

    /*Scopes end*/

    public function building_type()
    {
        return $this->belongsTo(CBuildingType::class, 'building_type_id');
    }

    public function building_floor_type()
    {
        return $this->belongsTo(CBuildingFloorType::class, 'building_floor_type_id');
    }


    public function elevator_type()
    {
        return $this->belongsTo(CElevatorType::class, 'elevator_type_id');
    }

    public function heating_system_type()
    {
        return $this->belongsTo(CHeatingSystemType::class, 'heating_system_type_id');
    }

    public function parking_type()
    {
        return $this->belongsTo(CParkingType::class, 'parking_type_id');
    }

    public function repairing_type()
    {
        return $this->belongsTo(CRepairingType::class, 'repairing_type_id');
    }

    public function service_fee_type()
    {
        return $this->belongsTo(CServiceFeeType::class, 'service_fee_type_id');
    }

    public function service_amount_currency()
    {
        return $this->belongsTo(CCurrency::class, 'service_amount_currency_id');
    }

    public function year()
    {
        return $this->belongsTo(CYear::class, 'year_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'seller_id');
    }

    public function seller()
    {
        return $this->belongsTo(Contact::class, 'seller_id');
    }


    public function owner()
    {
        return $this->belongsTo(Contact::class, 'seller_id');
    }


    public function sellerRenter()
    {
        return $this->belongsTo(Contact::class, 'seller_id');
    }


    public function renter()
    {
        return $this->hasManyThrough(Contact::class, EstateRentContract::class, 'id', 'estate_id', 'id', 'id');
    }

    public function renterContact()
    {
        return $this->belongsTo(Contact::class, 'renter_id');
    }

    public function currency()
    {
        return $this->belongsTo(CCurrency::class, 'currency_id');
    }

    public function estate_status()
    {
        return $this->belongsTo(CEstateStatus::class, 'estate_status_id');
    }

    public function estate_type()
    {
        return $this->belongsTo(CEstateType::class, 'estate_type_id');
    }

    public function location_city()
    {
        return $this->belongsTo(CLocationCity::class, 'location_city_id');
    }

    public function location_community()
    {
        return $this->belongsTo(CLocationCommunity::class, 'location_community_id');
    }

    public function location_country()
    {
        return $this->belongsTo(CLocationCountry::class, 'location_country_id');
    }

    public function location_province()
    {
        return $this->belongsTo(CLocationProvince::class, 'location_province_id');
    }

    public function location_street()
    {
        return $this->belongsTo(CLocationStreet::class, 'location_street_id');
    }

    public function registered_right()
    {
        return $this->belongsTo(CRegisteredRight::class, 'registered_right_id');
    }

    public function communication_type()
    {
        return $this->belongsTo(CCommunicationType::class, 'communication_id');
    }

    public function exterior_design_type()
    {
        return $this->belongsTo(CExteriorDesignType::class, 'exterior_design_type_id');
    }

    public function distance_public_objects()
    {
        return $this->belongsTo(CDistancePublicObject::class, 'distance_public_objects_id');
    }

    public function fence_type()
    {
        return $this->belongsTo(CFenceType::class, 'fence_type_id');
    }

    public function front_with_street()
    {
        return $this->belongsTo(CFrontWithStreet::class, 'front_with_street_id');
    }

    public function house_building_type()
    {
        return $this->belongsTo(CHouseBuildingType::class, 'house_building_type_id');
    }

    public function road_way_type()
    {
        return $this->belongsTo(CRoadWayType::class, 'road_way_type_id');
    }

    public function roof_material_type()
    {
        return $this->belongsTo(CRoofMaterialType::class, 'roof_material_type_id');
    }

    public function roof_type()
    {
        return $this->belongsTo(CRoofType::class, 'roof_type_id');
    }

    public function land_structure_type()
    {
        return $this->belongsTo(CLandStructureType::class, 'land_structure_type_id');
    }

    public function land_type()
    {
        return $this->belongsTo(CLandType::class, 'land_type_id');
    }

    public function land_use_type()
    {
        return $this->belongsTo(CLandUseType::class, 'land_use_type_id');
    }

    public function contract_type()
    {
        return $this->belongsTo(CContractType::class, 'contract_type_id');
    }

    public function building_structure_type()
    {
        return $this->belongsTo(CBuildingStructureType::class, 'building_structure_type_id');
    }

    public function building_project_type()
    {
        return $this->belongsTo(CBuildingProjectType::class, 'building_project_type_id');
    }

    public function courtyard_improvement()
    {
        return $this->belongsTo(CCourtyardImprovement::class, 'courtyard_improvement_id');
    }

    public function separate_entrance_type()
    {
        return $this->belongsTo(CSeparateEntranceType::class, 'separate_entrance_type_id');
    }

    public function vitrage_type()
    {
        return $this->belongsTo(CVitrageType::class, 'vitrage_type_id');
    }

    public function windows_view()
    {
        return $this->belongsTo(CWindowsView::class, 'windows_view_id');
    }

    public function building_window_count()
    {
        return $this->belongsTo(CBuildingWindowCount::class, 'building_window_count_id');
    }

    public function house_floors_type()
    {
        return $this->belongsTo(CHouseFloorsType::class, 'house_floors_type_id');
    }

    public function commercial_purpose_type()
    {
        return $this->belongsTo(CCommercialPurposeType::class, 'commercial_purpose_type_id');
    }

    public function entrance_type()
    {
        return $this->belongsTo(CEntranceType::class, 'entrance_type_id');
    }

    public function entrance_door_type()
    {
        return $this->belongsTo(CEntranceDoorType::class, 'entrance_door_type_id');
    }

    public function estateDocuments()
    {
        return $this->hasMany(EstateDocument::class)->orderBy('position');
    }


    public function entrance_door_position()
    {
        return $this->belongsTo(CEntranceDoorPosition::class, 'entrance_door_position_id');
    }

    public function ceiling_height_type()
    {
        return $this->belongsTo(CCeilingHeightType::class, 'ceiling_height_type_id');
    }

    public function agent()
    {
        return $this->belongsTo(RealtorUser::class, 'agent_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Contact::class, 'buyer_id');
    }



    public function propertyAgent()
    {
        return $this->belongsTo(RealtorUser::class, 'property_agent_id');
    }

    public function infoSource()
    {
        return $this->belongsTo(RealtorUser::class, 'info_source_id');
    }

    public function rentContracts()
    {
        return $this->hasMany(EstateRentContract::class, 'estate_id');
    }

    public function estateRentContracts()
    {
        return $this->belongsTo(EstateRentContract::class, 'estate_id');
    }


    public function potential_clients()
    {
        return $this->hasMany(Client::class, 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'b24_project_id', 'b24_project_id');
    }

    /*Methods*/

    public function getFullAddressAttribute($onlyStreet = false): ?string
    {
        $fullAddress = null;
        if ($this->getProvince()) {
            $fullAddress = $this->getProvince();
        }
        if ($this->getCommunity()) {
            $fullAddress .= ', ' . $this->getCommunity();
        }
        if ($this->getStreet()) {
            $fullAddress .= ', ' . $this->getStreet();
        }
        if ($this->address_building && !$onlyStreet) {
            $fullAddress .= ', ' . $this->address_building;
        }
        if ($this->address_apartment && !$onlyStreet) {
            $fullAddress .= ', ' . $this->address_apartment;
        }
        return $fullAddress;
    }

    public function getPublicFullAddressAttribute(): ?string
    {
        $fullAddress = null;
        if (!empty($this->getPublicProvince())) {

            $fullAddress = $this->getPublicProvince();
        }
        if ($this->getPublicCommunity()) {
            $fullAddress .= ', ' . $this->getPublicCommunity();
        }
        if ($this->getPublicStreet()) {
            $fullAddress .= ', ' . $this->getPublicStreet();
        }

        return $fullAddress;
    }


    public function getFullAddressForAutoTextAttribute($onlyStreet = false): ?string
    {
        $fullAddress = null;
        if ($this->getProvince()) {
            $fullAddress = $this->getProvince();
        }
        if ($this->getCommunity()) {
            $fullAddress .= ', ' . $this->getCommunity();
        }
        if ($this->getStreet()) {
            $fullAddress .= ', ' . $this->getStreet();
        }
        return $fullAddress;
    }

    public function getFullPriceAttribute(): ?string
    {
        $currency = session('currency') ?  session('currency') : 'AMD';

        return $this->getFormattedPrice() . ' ' . $currency;
    }

    public function getFullPriceWithChangeAttribute(): ?string
    {


        $fullPrice = $this->getFullPriceAttribute();

        if ($this->price_amd && $this->old_price && $this->price_amd < $this->old_price) {
            $fullPrice = $fullPrice . '<i class="las la-arrow-down" style="color: green; font-size: 28px"></i>';
        } elseif ($this->price_amd && $this->old_price && $this->price_amd > $this->old_price) {
            $fullPrice = $fullPrice . '<i class="las la-arrow-up" style="color: red; font-size: 28px"></i>';
        }

        return '<span style="background: #fff; display: inline-block; padding: 5px; border:1px solid #888; width: 100%">' . $fullPrice . '</span>';
    }

    /**
     * @throws BindingResolutionException
     */
    public function getFormattedPrice(): ?float
    {
        $currency = session('currency') ? session('currency') : 'AMD';
        $price = $this->price_amd;

        if ($currency === 'USD' || $currency === 'RUB') {
            $rate = App::make(CurrencyRateService::class)->getRate($currency);

            if (!$rate) {
                return null;
            }

            $price = $price / $rate;
        }

        return $this->roundPrice($price, $currency);
    }

    private function roundPrice(?float $price, ?string $currency): ?float
    {

        if ($price === null) {
            return null;
        }


        if ($currency === 'AMD') {
            return round($price / 100) * 100; // Round AMD to nearest 1000
        } elseif ($currency === 'RUB') {
            return round($price / 10) * 10; // Round RUB to nearest 10
        } elseif ($currency === 'USD') {
            return round($price); // Round RUB to nearest 10
        }

        return $price; // No rounding for other currencies
    }


    /**
     * @throws BindingResolutionException
     */
    public function getPricePerSquareAttribute(): ?float
    {
        if (!$this->area_total || !$this->price_amd) {
            return null;
        }

        $currency = session('currency') ? session('currency') : 'AMD';
        $price = $this->price_amd;

        if ($currency === 'USD' || $currency === 'RUB') {
            $rate = App::make(CurrencyRateService::class)->getRate($currency);

            if (!$rate) {
                return null;
            }

            $price = $price / $rate;
        }

        $pricePerSQM = ceil($price / $this->area_total);

        return $this->roundPrice($pricePerSQM, $currency);
    }

    public function getCoordinatesAttribute()
    {
        // Check if latitude and longitude attributes exist
        if (isset($this->attributes['estate_latitude']) && isset($this->attributes['estate_longitude'])) {
            // Access latitude and longitude attributes
            $latitude = $this->attributes['estate_latitude'];
            $longitude = $this->attributes['estate_longitude'];

            // Concatenate them into a single string
            return "{$latitude},{$longitude}";
        }

        return null;
    }

    public function getProvince(): ?string
    {
        return $this->location_province->name_arm ?? '';
    }

    public function getCommunity(): ?string
    {
        return $this->location_community->name_arm ?? '';
    }

    public function getStreet(): ?string
    {
        return $this->location_street->name_arm ?? '';
    }

    public function getPublicProvince(): ?string
    {
        if($this->location_province) {
            return $this->location_province->name;
        }
        return null;
    }

    public function getPublicCommunity(): ?string
    {
        if($this->location_community) {
            return $this->location_community->name;
        }

        return null;
    }

    public function getPublicStreet(): ?string
    {
        if($this->location_street) {
            return $this->location_street->name;
        }

        return null;
    }

    public function getFullCodeAttribute()
    {
        return $this->estate_type?->name_arm . '<br/>' . $this->code . '<br/>' . $this->contract_type?->name_arm;
    }

    public function getShortDescriptionAttribute()
    {
        $shortDescription = '';
        $contractType = '';
        $street = $this->getFullAddressAttribute(true) != null ? $this->getFullAddressAttribute(true) : "...";


        if ($this->estate_type_id === 1) {

            if(!$this->room_count || !$this->contract_type_id)  {
                return $street;
            }

            if ($this->contract_type_id === 1) {
                $contractType = trans("estate.label.generating.text.apartment.sale.1");
            } else if ($this->contract_type_id === 2) {
                $contractType = trans("estate.label.generating.text.apartment.rent.1");
            } else if ($this->contract_type_id === 3) {
                $contractType = trans("estate.label.generating.text.apartment.fee.1");
            }

            $shortDescription = $contractType .' '. $this->room_count .' '. trans('estate.' . "label.generating.text.apartment.sale.2") .' '. $street;
        }

        if ($this->estate_type_id === 2) {

            if(!$this->room_count || !$this->contract_type_id)  {
                return $street;
            }

            if ($this->contract_type_id === 1) {
                $contractType = trans("estate.label.generating.text.house.sale.1");
            } else if ($this->contract_type_id === 2) {
                $contractType = trans("estate.label.generating.text.house.rent.1");
            } else if ($this->contract_type_id === 3) {
                $contractType = trans("estate.label.generating.text.house.fee.1");
            }

            $shortDescription = $contractType .' '. $this->room_count .' '. trans('estate.' . "label.generating.text.house.sale.2") .' '. $street;
        }

        if ($this->estate_type_id === 3) {


            if ($this->contract_type_id === 1) {
                $contractType = trans("estate.label.generating.text.commercial.sale.1");
            } else if ($this->contract_type_id === 2) {
                $contractType = trans("estate.label.generating.text.commercial.rent.1");
            }
            $shortDescription .= $contractType.' ';


            $commercialPurposeType = $this->commercial_purpose_type;
            $commercialPurposeTypeName = $commercialPurposeType ? $commercialPurposeType->name_arm : null;

            // Check if commercial purpose type and its name are not null
            if ($commercialPurposeType !== null && $commercialPurposeTypeName !== null) {
                // Append the commercial purpose type name to the title
                $shortDescription .= ' ' . $commercialPurposeTypeName;

                //TODO: Check if commercial purpose type matches specified IDs and append message if true , refactor hardcoded
                $officeId = 23;
                $universalId = 28;

                if ($commercialPurposeType->id === $officeId || $commercialPurposeType->id === $universalId) {
                    $shortDescription .= ' ' . trans("estate.label.title.commercial");
                }
            }


            $shortDescription .= ' ' . $street;

        }

        if ($this->estate_type_id === 4) {


            if ($this->contract_type_id === 1) {
                $contractType = trans("estate.label.generating.text.land.sale.1");
            } else if ($this->contract_type_id === 2) {
                $contractType = trans("estate.label.generating.text.land.rent.1");
            }
            $shortDescription .= $contractType.' ';


            $landUseType = $this->land_use_type;
            $landUseTypeName = $landUseType ? $landUseType->name_arm : null;

            // Check if commercial purpose type and its name are not null
            if ($landUseType !== null && $landUseTypeName !== null) {
                // Append the commercial purpose type name to the title
                $shortDescription .= ' ' . $landUseTypeName;

                //TODO: Check if commercial purpose type matches specified IDs and append message if true , refactor hardcoded
                $officeId = 23;
                $universalId = 28;

                if ($landUseType->id === $officeId || $landUseType->id === $universalId) {
                    $shortDescription .= ' ' . trans("estate.label.title.land");
                }
            }


            $shortDescription .= ' ' . $street;

        }



        return $shortDescription;
    }

    public function getPublicShortDescriptionAttribute()
    {
        $shortDescription = '';
        $contractType = '';
        $street = $this->getPublicFullAddressAttribute() != null ? $this->getPublicFullAddressAttribute(true) : "...";


        if ($this->estate_type_id === 1) {

            if(!$this->room_count || !$this->contract_type_id)  {
                return $street;
            }

            if ($this->contract_type_id === 1) {
                $contractType = trans("estate.label.generating.text.apartment.sale.1");
            } else if ($this->contract_type_id === 2) {
                $contractType = trans("estate.label.generating.text.apartment.rent.1");
            } else if ($this->contract_type_id === 3) {
                $contractType = trans("estate.label.generating.text.apartment.fee.1");
            }

            $shortDescription = $contractType .' '. $this->room_count .' '. trans('estate.' . "label.generating.text.apartment.sale.2") .' '. $street;
        }

        if ($this->estate_type_id === 2) {

            if(!$this->room_count || !$this->contract_type_id)  {
                return $street;
            }

            if ($this->contract_type_id === 1) {
                $contractType = trans("estate.label.generating.text.house.sale.1");
            } else if ($this->contract_type_id === 2) {
                $contractType = trans("estate.label.generating.text.house.rent.1");
            } else if ($this->contract_type_id === 3) {
                $contractType = trans("estate.label.generating.text.house.fee.1");
            }

            $shortDescription = $contractType .' '. $this->room_count .' '. trans('estate.' . "label.generating.text.house.sale.2") .' '. $street;
        }

        if ($this->estate_type_id === 3) {


            if ($this->contract_type_id === 1) {
                $contractType = trans("estate.label.generating.text.commercial.sale.1");
            } else if ($this->contract_type_id === 2) {
                $contractType = trans("estate.label.generating.text.commercial.rent.1");
            }
            $shortDescription .= $contractType.' ';


            $commercialPurposeType = $this->commercial_purpose_type;
            $commercialPurposeTypeName = $commercialPurposeType ? $commercialPurposeType->name_arm : null;

            // Check if commercial purpose type and its name are not null
            if ($commercialPurposeType !== null && $commercialPurposeTypeName !== null) {
                // Append the commercial purpose type name to the title
                $shortDescription .= ' ' . $commercialPurposeTypeName;

                //TODO: Check if commercial purpose type matches specified IDs and append message if true , refactor hardcoded
                $officeId = 23;
                $universalId = 28;

                if ($commercialPurposeType->id === $officeId || $commercialPurposeType->id === $universalId) {
                    $shortDescription .= ' ' . trans("estate.label.title.commercial");
                }
            }


            $shortDescription .= ' ' . $street;

        }

        if ($this->estate_type_id === 4) {


            if ($this->contract_type_id === 1) {
                $contractType = trans("estate.label.generating.text.land.sale.1");
            } else if ($this->contract_type_id === 2) {
                $contractType = trans("estate.label.generating.text.land.rent.1");
            }
            $shortDescription .= $contractType.' ';


            $landUseType = $this->land_use_type;
            $landUseTypeName = $landUseType ? $landUseType->name_arm : null;

            // Check if commercial purpose type and its name are not null
            if ($landUseType !== null && $landUseTypeName !== null) {
                // Append the commercial purpose type name to the title
                $shortDescription .= ' ' . $landUseTypeName;

                //TODO: Check if commercial purpose type matches specified IDs and append message if true , refactor hardcoded
                $officeId = 23;
                $universalId = 28;

                if ($landUseType->id === $officeId || $landUseType->id === $universalId) {
                    $shortDescription .= ' ' . trans("estate.label.title.land");
                }
            }


            $shortDescription .= ' ' . $street;

        }



        return $shortDescription;
    }

    /*Local scopes*/

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApartment($query)
    {
        return $query->orWhere('estate_type_id', '=', 1);
    }

    public function scopeHouse($query)
    {
        return $query->orWhere('estate_type_id', '=', 2);
    }

    public function scopeTownhouse($query)
    {
        return $query->orWhere('estate_type_id', '=', 5);
    }

    public function scopeCommercial($query)
    {
        return $query->orWhere('estate_type_id', '=', 3);
    }

    public function scopeLand($query)
    {
        return $query->orWhere('estate_type_id', '=', 4);
    }

    public function scopeIsExclusive($query)
    {
        return $query->orWhereNotNull('agent_id');
    }

    public function scopeIsNotExclusive($query)
    {
        return $query->orWhereNull('agent_id');
    }

    public function scopeIsReadyFromRent($query)
    {

        return $query->where(function ($query) {
            $query->where(function ($subQuery) {
                $subQuery->select(DB::raw('CASE
                                            WHEN end_date IS NULL THEN 0
                                            WHEN end_date < now() THEN 1
                                            ELSE 0
                                        END AS checker'))
                    ->from('estate_rent_contract')
                    ->whereColumn('estate.id', 'estate_rent_contract.estate_id')
                    ->orderByDesc('id')
                    ->limit(1);
            }, '=', 1);
        });
    }


    public function readyFromRent()
    {
        $now =  Carbon::now();;

        $latestRentContract = $this->rentContracts()
            ->orderBy('id', 'desc')
            ->first();

        if (!$latestRentContract) {
            return false;
        }

        if($latestRentContract->end_date !== null && Carbon::parse($latestRentContract->end_date)->lt($now)) {
            return true;
        }
        return  false;

    }

    public function getStoragePathAttribute(): string
    {
        $name = $this->main_image_file_path;

        return "/estate/photos/$name";
    }

    public function getStatusTextAttribute(): string
    {
        return $this->estate_status->name_arm;
    }

    public function getStatusSpanAttribute(): string
    {

        $statusIcon = '';

        if ($this->estate_status === 1) {
            $statusIcon = '<i class="las la-file" style="font-size: 24px; color: #C00"  title="Սևագիր"></i>';
        }

        if ($this->estate_status === 2) {
            $statusIcon = '<i class="las la-file-alt" style="font-size: 24px; color: #939309"  title="Թերի Լրացված"></i>';
        }

        if ($this->estate_status === 3) {
            $statusIcon = '<i class="las la-camera-retro" style="font-size: 24px; color: #00a2d6"  title="Տեղազնված"></i>';
        }

        if ($this->estate_status === 4) {
            $statusIcon = '<i class="las la-check-square" style="font-size: 24px; color: #066c3c"  title="Հաստատված"></i>';
        }

        if ($this->estate_status === 6) {
            $statusIcon = '<i class="las la-tag" style="font-size: 24px; color: #066c3c" title="Վարձակալված"></i>';
        }


        if ($this->estate_status === 7) {
            $statusIcon = '<i class="las la-calendar-check" style="font-size: 24px; color: #9369aa" title="Վաճառված"></i>';
        }

        if ($this->estate_status === 8) {
            $statusIcon = '<i class="las la-file-download" style="font-size: 24px; color: #222f3e" title="Արխիվացված"></i>';
        }

        if($this->is_urgent == 1) {
            $statusIcon .= '<i class="las la-bolt" style="font-size: 24px; color: #fd9002" title="Շտապ"></i>';
        }

        if($this->is_from_public == 1) {
            $statusIcon .= '<i class="las la-file-export" style="font-size: 24px; color: #fd9002" title="Ձևակերպված է որպես հայտ"></i>';
        }

        if($this->archive_till_date != null && $this->estate_status === 8) {
            $archiveDate = Carbon::parse($this->archive_till_date);;
            $currentDate = Carbon::now();
            if ($currentDate->greaterThanOrEqualTo($archiveDate)) {
                $statusIcon .= '<i class="las la-external-link-square-alt" style="font-size: 24px; color: #e800d7" title="Պատրաստ է վերականգնման"></i>';
            }
        }

        if($this->readyFromRent()  && $this->estate_status === 6) {
            $archiveDate = Carbon::parse($this->archive_till_date);
            $currentDate = Carbon::now();
            if ($currentDate->greaterThanOrEqualTo($archiveDate)) {
                $statusIcon .= '<i class="las la-external-link-square-alt" style="font-size: 24px; color: #c4003a" title="Վարձակալված գույքը պատրաստ է վերականգնման"></i>';
            }
        }



        return $statusIcon;

    }



    /*Activity logs*/
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->logExcept(['temporary_photos'])
            ->logOnly(['*', 'estate_status.name_arm']);
    }
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\ApiMultiLanguage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Announcement
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
 * @property string|null $comment_ar
 * @property int|null $last_modified_by
 * @property string|null $additional_info_arm
 * @property string|null $additional_info_eng
 * @property string|null $additional_info_ru
 * @property string|null $additional_info_ar
 * @property string|null $name_arm
 * @property string|null $name_eng
 * @property string|null $name_ru
 * @property string|null $name_ar
 * @property string|null $selling_comment_arm
 * @property string|null $selling_comment_eng
 * @property string|null $selling_comment_ru
 * @property string|null $selling_comment_ar
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
 * @property string|null $appointment_comment_ar
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
 * @property string|null $archive_comment_ar
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
class Announcement extends Model
{
	protected $table = 'announcement';

	public $timestamps = false;
    use ApiMultiLanguage;
    protected  $multi_lang = [
        'name',
    ];


	protected $casts = [
		'id' => 'int',
		'location_country_id' => 'int',
		'location_province_id' => 'int',
		'location_city_id' => 'int',
		'location_community_id' => 'int',
		'location_street_id' => 'int',
		'estate_type_id' => 'int',
		'area_total' => 'float',
		'old_price' => 'float',
		'price' => 'float',
		'currency_id' => 'int',
		'seller_id' => 'int',
		'area_residential' => 'float',
		'registered_right_id' => 'int',
		'repairing_type_id' => 'int',
		'room_count' => 'int',
		'building_type_id' => 'int',
		'building_project_type_id' => 'int',
		'conditioner' => 'bool',
		'room_count_modified' => 'int',
		'exterior_design_type_id' => 'int',
		'elevator_type_id' => 'int',
		'year_id' => 'int',
		'heating_system_type_id' => 'int',
		'parking_type_id' => 'int',
		'service_fee_type_id' => 'int',
		'service_amount' => 'float',
		'service_amount_currency_id' => 'int',
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
		'roof_type_id' => 'int',
		'floor_count_id' => 'int',
		'house_building_type_id' => 'int',
		'roof_repaired' => 'bool',
		'roof_material_type_id' => 'int',
		'fence_type_id' => 'int',
		'communication_type_id' => 'int',
		'front_with_street_id' => 'int',
		'road_way_type_id' => 'int',
		'commercial_purpose_type_id' => 'int',
		'communication_id' => 'int',
		'land_structure_type_id' => 'int',
		'land_type_id' => 'int',
		'land_use_type_id' => 'int',
		'front_length' => 'float',
		'version' => 'int',
		'contract_type_id' => 'int',
		'entrance_door_type_id' => 'int',
		'entrance_door_position_id' => 'int',
		'windows_view_id' => 'int',
		'building_floor_count' => 'int',
		'house_floors_type_id' => 'int',
		'roof_drainage' => 'bool',
		'new_doors' => 'bool',
		'new_windows' => 'bool',
		'new_bathroom' => 'bool',
		'new_floor' => 'bool',
		'new_roof' => 'bool',
		'can_be_used_as_commercial' => 'bool',
		'is_published' => 'bool',
		'estate_status_id' => 'int',
		'status_id_before_archive' => 'int',
		'buyer_id' => 'int',
		'agent_id' => 'int',
		'selling_price_init' => 'float',
		'selling_price_final' => 'float',
		'selling_price_final_currency_id' => 'int',
		'selling_price_init_currency_id' => 'int',
		'new_construction' => 'bool',
		'floor' => 'int',
		'last_modified_by' => 'int',
		'created_by' => 'int',
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
		'property_agent_id' => 'int',
		'ceiling_height_type_id' => 'int',
		'building_structure_type_id' => 'int',
		'building_floor_type_id' => 'int',
		'vitrage_type_id' => 'int',
		'separate_entrance_type_id' => 'int',
		'filled_by' => 'int',
		'verified_by' => 'int',
		'entrance_type_id' => 'int',
		'has_neighbour' => 'bool',
		'is_advertised' => 'bool',
		'info_source_id' => 'int',
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
		'visits_count' => 'int',
		'is_from_public' => 'bool',
		'is_hot_offer' => 'bool',
		'is_on_main_page' => 'bool'
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
		'on_main_page_start_date'
	];

	protected $fillable = [
		'location_country_id',
		'location_province_id',
		'location_city_id',
		'location_community_id',
		'location_street_id',
		'estate_type_id',
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
		'comment_ar',
		'last_modified_by',
		'additional_info_arm',
		'additional_info_eng',
		'additional_info_ru',
		'additional_info_ar',
		'name_arm',
		'name_eng',
		'name_ru',
		'name_ar',
		'selling_comment_arm',
		'selling_comment_eng',
		'selling_comment_ru',
		'selling_comment_ar',
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
		'appointment_comment_ar',
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
		'archive_till_date',
		'archive_comment_arm',
		'archive_comment_eng',
		'archive_comment_ru',
		'archive_comment_ar',
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
		'on_main_page_start_date'
	];

	public function c_building_type()
	{
		return $this->belongsTo(CBuildingType::class, 'building_type_id');
	}

	public function c_elevator_type()
	{
		return $this->belongsTo(CElevatorType::class, 'elevator_type_id');
	}

	public function c_heating_system_type()
	{
		return $this->belongsTo(CHeatingSystemType::class, 'heating_system_type_id');
	}

	public function c_parking_type()
	{
		return $this->belongsTo(CParkingType::class, 'parking_type_id');
	}

	public function c_repairing_type()
	{
		return $this->belongsTo(CRepairingType::class, 'repairing_type_id');
	}

	public function c_service_fee_type()
	{
		return $this->belongsTo(CServiceFeeType::class, 'service_fee_type_id');
	}

	public function c_year()
	{
		return $this->belongsTo(CYear::class, 'year_id');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'seller_id');
	}

	public function c_currency()
	{
		return $this->belongsTo(CCurrency::class, 'currency_id');
	}

	public function c_estate_type()
	{
		return $this->belongsTo(CEstateType::class, 'estate_type_id');
	}

	public function c_location_city()
	{
		return $this->belongsTo(CLocationCity::class, 'location_city_id');
	}

	public function c_location_community()
	{
		return $this->belongsTo(CLocationCommunity::class, 'location_community_id');
	}

	public function c_location_country()
	{
		return $this->belongsTo(CLocationCountry::class, 'location_country_id');
	}

	public function c_location_province()
	{
		return $this->belongsTo(CLocationProvince::class, 'location_province_id');
	}

	public function c_location_street()
	{
		return $this->belongsTo(CLocationStreet::class, 'location_street_id');
	}

	public function c_registered_right()
	{
		return $this->belongsTo(CRegisteredRight::class, 'registered_right_id');
	}

	public function c_communication_type()
	{
		return $this->belongsTo(CCommunicationType::class, 'communication_id');
	}

	public function c_exterior_design_type()
	{
		return $this->belongsTo(CExteriorDesignType::class, 'exterior_design_type_id');
	}

	public function c_fence_type()
	{
		return $this->belongsTo(CFenceType::class, 'fence_type_id');
	}

	public function c_front_with_street()
	{
		return $this->belongsTo(CFrontWithStreet::class, 'front_with_street_id');
	}

	public function c_house_building_type()
	{
		return $this->belongsTo(CHouseBuildingType::class, 'house_building_type_id');
	}

	public function c_road_way_type()
	{
		return $this->belongsTo(CRoadWayType::class, 'road_way_type_id');
	}

	public function c_roof_material_type()
	{
		return $this->belongsTo(CRoofMaterialType::class, 'roof_material_type_id');
	}

	public function c_roof_type()
	{
		return $this->belongsTo(CRoofType::class, 'roof_type_id');
	}

	public function c_land_structure_type()
	{
		return $this->belongsTo(CLandStructureType::class, 'land_structure_type_id');
	}

	public function c_land_type()
	{
		return $this->belongsTo(EstateOptionType::class, 'land_type_id');
	}
}

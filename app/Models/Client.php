<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Services\CurrencyRateService;
use App\Traits\ApiMultiLanguage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;

/**
 * Class Client
 *
 * @property int $id
 * @property int|null $contact_id
 * @property int|null $version
 * @property int|null $estate_type_id
 * @property int|null $estate_contract_type_id
 * @property int|null $location_province_id
 * @property int|null $location_city_id
 * @property int|null $location_community_id
 * @property int|null $location_street_id
 * @property int|null $currency_id
 * @property float|null $price_from
 * @property float|null $price_from_usd
 * @property float|null $price_from_amd
 * @property float|null $price_to
 * @property float|null $price_to_usd
 * @property float|null $price_to_amd
 * @property float|null $area_from
 * @property float|null $area_to
 * @property int|null $room_count_from
 * @property int|null $room_count_to
 * @property int|null $building_type_id
 * @property int|null $repairing_type_id
 * @property bool|null $new_construction
 * @property int|null $broker_id
 * @property int|null $info_source_id
 * @property string|null $location_building
 * @property int|null $contact_status_id
 * @property Carbon|null $status_changed_on
 * @property bool|null $is_urgent
 * @property Carbon|null $archive_till_date
 * @property string|null $archive_comment
 * @property bool|null $is_from_public
 *
 * @package App\Models
 */
class Client extends Model
{
	protected $table = 'client';

	public $timestamps = false;

    use ApiMultiLanguage;
    use CrudTrait;
    protected array $multi_lang = [
        'name',
    ];

	protected $casts = [
		'id' => 'int',
		'contact_id' => 'int',
		'version' => 'int',
		'estate_type_id' => 'int',
		'estate_contract_type_id' => 'int',
		'location_province_id' => 'int',
		'location_city_id' => 'int',
		'location_community_id' => 'int',
		'location_street_id' => 'int',
		'currency_id' => 'int',
		'price_from' => 'float',
		'price_from_usd' => 'float',
		'price_from_amd' => 'float',
		'price_to' => 'float',
		'price_to_usd' => 'float',
		'price_to_amd' => 'float',
		'area_from' => 'float',
		'area_to' => 'float',
		'room_count_from' => 'int',
		'room_count_to' => 'int',
		'building_type_id' => 'int',
		'repairing_type_id' => 'int',
		'new_construction' => 'bool',
		'broker_id' => 'int',
		'info_source_id' => 'int',
		'contact_status_id' => 'int',
		'is_urgent' => 'bool',
		'is_from_public' => 'bool'
	];

	protected $dates = [
		'status_changed_on',
		'archive_till_date'
	];

	protected $fillable = [
		'contact_id',
		'version',
		'estate_type_id',
		'estate_contract_type_id',
		'location_province_id',
		'location_city_id',
		'location_community_id',
		'location_street_id',
		'currency_id',
		'price_from',
		'price_from_usd',
		'price_from_amd',
		'price_to',
		'price_to_usd',
		'price_to_amd',
		'area_from',
		'area_to',
		'room_count_from',
		'room_count_to',
		'building_type_id',
		'repairing_type_id',
		'new_construction',
		'broker_id',
		'info_source_id',
		'project_id',
		'location_building',
		'contact_status_id',
		'status_changed_on',
		'is_urgent',
		'archive_till_date',
		'archive_comment',
		'is_from_public',
        'contact_type_id',
        'name_arm',
        'last_name_arm',
        'phone_mobile_1',
	];

    public function getTypeListAttribute($relation, $column)
    {
        if ($this->$relation->isNotEmpty()) {
            return $this->$relation->pluck($column)->implode(', ');
        }
        return null;
    }

//    public function building_types()
//    {
//        return $this->hasOneThrough(
//            CBuildingType::class,
//            'App\Models\ClientBuildingType',
//            'client_id',
//            'id',
//            'id',
//            'building_type_id',
//        );
//    }

    public function client_building_types()
    {
        return $this->belongsToMany(CBuildingType::class, 'client_building_type', 'client_id', 'building_type_id');
    }

    public function client_repairing_types()
    {
        return $this->belongsToMany(CRepairingType::class, 'client_repairing_type', 'client_id', 'repairing_type_id');
    }

    public function client_building_project__types()
    {
        return $this->belongsToMany(CBuildingProjectType::class, 'client_building_project_type', 'client_id', 'building_project_type_id');
    }


    public function repairing_types()
    {
        return $this->hasManyThrough(
            CRepairingType::class,
            'App\Models\ClientRepairingType',
            'client_id',
            'id',
            'id',
            'repairing_type_id',
        );
    }

    public function building_project_types()
    {
        return $this->hasManyThrough(
            CBuildingProjectType::class,
            'App\Models\ClientBuildingProjectType',
            'client_id',
            'id',
            'id',
            'building_project_type_id',
        );
    }

    public function land_use_types()
    {
        return $this->hasManyThrough(
            CLandUseType::class,
            'App\Models\ClientLandUseType',
            'client_id',
            'id',
            'id',
            'land_use_type_id',
        );
    }


    public function communities()
    {
        return $this->belongsToMany(
            CLocationCommunity::class,
            'client_community',
            'client_id',
            'community_id',
            'id',
            'id',
        );
    }

    public function location_city()
    {
        return $this->belongsTo(CLocationCity::class, 'location_city_id');
    }

    public function location_province()
    {
        return $this->belongsTo(CLocationProvince::class, 'location_province_id');
    }

    public function location_street()
    {
        return $this->belongsTo(CLocationStreet::class, 'location_street_id');
    }

    public function estate_type()
    {
        return $this->belongsTo(CEstateType::class, 'estate_type_id');
    }

    public function contract_type()
    {
        return $this->belongsTo(CContractType::class, 'estate_contract_type_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(CCurrency::class, 'currency_id');
    }

    public function getClientContractTypeRentsAttribute()
    {
        return $this->contract_type()->where('id', '!=', 1)->first();
    }

    public function contact_status()
    {
        return $this->belongsTo(CContactStatus::class, 'contact_status_id');
    }

    public function broker()
    {
        return $this->belongsTo(RealtorUser::class, 'broker_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function getFullContactAttribute()
    {
        return $this->name_arm.' '.$this->last_name_arm.' ('.$this->phone_mobile_1.')';
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(RealtorUser::class, 'referral_id');
    }

    public function infoSource(): BelongsTo
    {
        return $this->belongsTo(B24InfoSource::class, 'info_source_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getBuildingTypesListAttribute()
    {
        return $this->getTypeListAttribute('client_building_types', 'name_arm');
    }

    public function getRepairingTypesListAttribute()
    {
        return $this->getTypeListAttribute('repairing_types', 'name_arm');
    }

    public function getBuildingProjectTypesListAttribute()
    {
        return $this->getTypeListAttribute('building_project_types', 'name_arm');
    }

    public function getCommunityListAttribute()
    {
        return $this->getTypeListAttribute('communities', 'name_arm');
    }

    public function getLandUseTypesListAttribute()
    {
        return $this->getTypeListAttribute('land_use_types', 'name_arm');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Client $client) {
            if (! $client->exists || $client->isDirty(['currency_id', 'price_from', 'price_to'])) {
                $client->normalizeBudgetToAmd(App::make(CurrencyRateService::class));
            }
        });

        static::saved(function ($client) {
            if ($client->contact) {
                $client->contact_type_id = $client->contact->contact_type_id;
                $client->name_arm = $client->contact->name_arm;
                $client->last_name_arm = $client->contact->last_name_arm;
                $client->phone_mobile_1 = $client->contact->phone_mobile_1;
                $client->saveQuietly();
            }
        });
    }

    public function normalizeBudgetToAmd(CurrencyRateService $rateService): void
    {
        $iso = 'AMD';

        if ($this->currency_id !== null) {
            $currency = $this->relationLoaded('currency')
                && $this->currency?->getKey() === $this->currency_id
                    ? $this->currency
                    : $this->currency()->first();
            $iso = $currency?->iso_code;

            if ($iso === null) {
                throw ValidationException::withMessages([
                    'currency_id' => 'The selected budget currency is not supported.',
                ]);
            }
        }

        $rate = $iso === 'AMD' ? 1.0 : $rateService->getRate($iso);

        if ($rate === null || $rate <= 0) {
            throw ValidationException::withMessages([
                'currency_id' => "The {$iso} exchange rate is not available.",
            ]);
        }

        $this->price_from_amd = $this->toAmd($this->price_from, $rate);
        $this->price_to_amd = $this->toAmd($this->price_to, $rate);
    }

    private function toAmd(?float $amount, float $rate): ?float
    {
        return $amount === null ? null : round($amount * $rate, 3);
    }
}

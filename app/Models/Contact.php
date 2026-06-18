<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\ApiMultiLanguage;
use App\Traits\Models\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 * Class Contact
 *
 * @property int $id
 * @property bool|null $is_deleted
 * @property Carbon|null $last_modified_on
 * @property int|null $version
 * @property string|null $email
 * @property string|null $organization
 * @property int|null $contact_type_id
 * @property string|null $phone_mobile_1
 * @property string|null $phone_mobile_2
 * @property string|null $phone_office
 * @property string|null $phone_home
 * @property string|null $fax
 * @property string|null $comment_arm
 * @property string|null $comment_eng
 * @property string|null $comment_ru
 * @property string|null $comment_ar
 * @property int|null $last_modified_by
 * @property string|null $name_arm
 * @property string|null $name_eng
 * @property string|null $name_ru
 * @property string|null $name_ar
 * @property string|null $last_name_arm
 * @property string|null $last_name_eng
 * @property string|null $last_name_ru
 * @property string|null $last_name_ar
 * @property bool|null $is_seller
 * @property bool|null $is_buyer
 * @property bool|null $is_rent_owner
 * @property bool|null $is_renter
 * @property bool|null $is_inner_agent
 * @property Carbon|null $created_on
 * @property int|null $created_by
 * @property bool|null $is_from_public
 * @property int|null $estate_type_id
 * @property int|null $estate_contract_type_id
 * @property int|null $location_province_id
 * @property int|null $location_city_id
 * @property int|null $location_community_id
 * @property int|null $location_street_id
 * @property int|null $currency_id
 * @property float|null $price_from
 * @property float|null $price_from_usd
 * @property float|null $price_to
 * @property float|null $price_to_usd
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
 * @property bool|null $is_urgent
 * @property string|null $web_site
 * @property string|null $phone_mobile_3
 * @property string|null $phone_mobile_4
 * @property string|null $viber
 * @property string|null $whatsapp
 *
 * @property Collection|Announcement[] $announcements
 * @property Collection|Estate[] $estates
 *
 * @package App\Models
 */
class Contact extends Model
{
    use CrudTrait;

	protected $table = 'contact';

    use ApiMultiLanguage;
    use LogsActivity;

    protected array $multi_lang = [
        'name',
    ];

//    protected string $identifiableAttribute = 'name_arm';

	protected $casts = [
		'id' => 'int',
		'is_deleted' => 'bool',
		'version' => 'int',
		'contact_type_id' => 'int',
		'last_modified_by' => 'int',
		'is_seller' => 'bool',
		'is_buyer' => 'bool',
		'is_rent_owner' => 'bool',
		'is_renter' => 'bool',
		'is_inner_agent' => 'bool',
		'created_by' => 'int',
		'is_from_public' => 'bool',
		'estate_type_id' => 'int',
		'estate_contract_type_id' => 'int',
		'location_province_id' => 'int',
		'location_city_id' => 'int',
		'location_community_id' => 'int',
		'location_street_id' => 'int',
		'currency_id' => 'int',
		'price_from' => 'float',
		'price_from_usd' => 'float',
		'price_to' => 'float',
		'price_to_usd' => 'float',
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
		'is_urgent' => 'bool'
	];

	protected $dates = [
		'last_modified_on',
		'created_on'
	];

	protected $fillable = [
		'is_deleted',
		'last_modified_on',
		'version',
		'email',
		'organization',
		'contact_type_id',
		'phone_mobile_1',
		'phone_mobile_2',
		'phone_office',
		'phone_home',
		'fax',
		'comment_arm',
		'comment_eng',
		'comment_ru',
		'comment_ar',
		'last_modified_by',
		'name_arm',
		'name_eng',
		'name_ru',
		'name_ar',
		'last_name_arm',
		'last_name_eng',
		'last_name_ru',
		'last_name_ar',
		'is_seller',
		'is_buyer',
		'is_rent_owner',
		'is_renter',
		'is_inner_agent',
		'created_on',
		'created_by',
		'is_from_public',
		'estate_type_id',
		'estate_contract_type_id',
		'location_province_id',
		'location_city_id',
		'location_community_id',
		'location_street_id',
		'currency_id',
		'price_from',
		'price_from_usd',
		'price_to',
		'price_to_usd',
		'area_from',
		'area_to',
		'room_count_from',
		'room_count_to',
		'building_type_id',
		'repairing_type_id',
		'new_construction',
		'broker_id',
		'info_source_id',
		'location_building',
		'contact_status_id',
		'is_urgent',
		'web_site',
		'phone_mobile_3',
		'phone_mobile_4',
		'viber',
		'whatsapp',
        'b24_lead_id',
        'b24_contact_id',
        'project_id',
        'b24_lead_project_id',
        'b24_contact_project_id',
	];
    protected $appends = ['fullName', 'fullContact'];

    protected static function booted(): void
    {
        static::creating(function (Contact $contact) {
            if (Auth::check()) {
                $contact->created_by = Auth::id();
            }
        });
    }

    public function createdBy(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function user()
    {
        return $this->hasOne(RealtorUser::class, 'contact_id');
    }

    public function contact_type()
    {
        return $this->belongsTo(CContactType::class, 'contact_type_id');
    }

    public function contact_status()
    {
        return $this->belongsTo(CContactStatus::class, 'contact_status_id');
    }

    public function estate_type()
    {
        return $this->belongsTo(CEstateType::class, 'estate_type_id');
    }

    public function estate_contract_type()
    {
        return $this->belongsTo(CContractType::class, 'estate_contract_type_id');
    }

    public function broker()
    {
        return $this->belongsTo(Contact::class, 'broker_id');
    }
	public function announcements()
	{
		return $this->hasMany(Announcement::class, 'seller_id');
	}

    public function currency()
    {
        return $this->belongsTo(CCurrency::class, 'currency_id');
    }

	public function estates()
	{
		return $this->hasMany(Estate::class, 'seller_id');
	}

    public function buyerEstates(): HasMany
    {
        return $this->hasMany(Estate::class, 'buyer_id');
    }

    public function location_province()
    {
        return $this->belongsTo(CLocationProvince::class, 'location_province_id');
    }

    public function location_street()
    {
        return $this->belongsTo(CLocationStreet::class, 'location_street_id');
    }

    public function location_city()
    {
        return $this->belongsTo(CLocationCity::class, 'location_city_id');
    }

    public function location_community()
    {
        return $this->belongsTo(CLocationCommunity::class, 'location_community_id');
    }


    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function potential_estates()
    {
        return $this->hasMany(Estate::class, 'id');
    }


    public function getFullNameAttribute()
    {
        return $this->name_arm.' '.$this->last_name_arm;
    }

    public function getFullNameEngAttribute()
    {
        return $this->name_eng.' '.$this->last_name_eng;
    }

    public function getFullContactAttribute()
    {
        return $this->name_arm.' '.$this->last_name_arm.' ('.$this->phone_mobile_1.')';
    }

}

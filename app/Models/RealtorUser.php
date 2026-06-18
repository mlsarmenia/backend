<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Traits\Models\HasFilePath;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RealtorUser
 *
 * @property int $id
 * @property int|null $contact_id
 * @property string|null $username
 * @property string|null $password
 * @property int|null $version
 * @property bool|null $is_deleted
 * @property int|null $profession_type_id
 * @property Carbon|null $last_modified_on
 * @property int|null $last_modified_by
 * @property Carbon|null $created_on
 * @property int|null $created_by
 * @property bool|null $is_from_public
 * @property bool|null $is_active
 * @property bool|null $is_blocked
 * @property string|null $profile_picture_name
 * @property string|null $profile_picture_path
 * @property string|null $activation_code
 * @property int|null $view_count
 * @property int|null $party_type_id
 * @property int|null $contact_visits_count
 * @property int|null $screened_count
 * @property int|null $packet_type_id
 * @property Carbon|null $packet_start_date
 * @property Carbon|null $packet_end_date
 * @property int|null $menu_location_province_id
 * @property string|null $meta_title_eng
 * @property string|null $meta_title_arm
 * @property string|null $meta_title_ru
 * @property string|null $meta_description_eng
 * @property string|null $meta_description_arm
 * @property string|null $meta_description_ru
 * @property int|null $permission_menu_packet_type_id
 * @property Carbon|null $permission_menu_packet_start_date
 * @property Carbon|null $permission_menu_packet_end_date
 * @property int|null $permission_menu_location_province_id
 *
 * @property Collection|RealtorUserRole[] $realtor_user_roles
 *
 * @package App\Models
 */
class RealtorUser extends Model
{
    use CrudTrait;
    use HasFilePath;

	protected $table = 'realtor_user';

	protected $casts = [
		'id' => 'int',
		'contact_id' => 'int',
		'version' => 'int',
		'is_deleted' => 'bool',
		'profession_type_id' => 'int',
		'last_modified_by' => 'int',
		'created_by' => 'int',
		'is_from_public' => 'bool',
		'is_active' => 'bool',
		'is_blocked' => 'bool',
		'view_count' => 'int',
		'party_type_id' => 'int',
		'contact_visits_count' => 'int',
		'screened_count' => 'int',
		'packet_type_id' => 'int',
		'menu_location_province_id' => 'int',
		'permission_menu_packet_type_id' => 'int',
		'permission_menu_location_province_id' => 'int'
	];

	protected $dates = [
		'last_modified_on',
		'created_on',
		'packet_start_date',
		'packet_end_date',
		'permission_menu_packet_start_date',
		'permission_menu_packet_end_date'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'contact_id',
		'username',
		'password',
		'version',
		'is_deleted',
		'profession_type_id',
		'last_modified_on',
		'last_modified_by',
		'created_on',
		'created_by',
		'is_from_public',
		'is_active',
		'is_blocked',
		'profile_picture_name',
		'profile_picture_path',
		'activation_code',
		'view_count',
		'party_type_id',
		'contact_visits_count',
		'screened_count',
		'packet_type_id',
		'packet_start_date',
		'packet_end_date',
		'menu_location_province_id',
		'meta_title_eng',
		'meta_title_arm',
		'meta_title_ru',
		'meta_description_eng',
		'meta_description_arm',
		'meta_description_ru',
		'permission_menu_packet_type_id',
		'permission_menu_packet_start_date',
		'permission_menu_packet_end_date',
		'permission_menu_location_province_id'
	];

    protected $appends = ['contactFullName'];

	public function realtor_user_roles()
	{
		return $this->hasMany(RealtorUserRole::class, 'user_id');
	}

    public function roles()
    {
        return $this->belongsToMany(CRole::class, 'realtor_user_role', 'user_id', 'role_id', 'id', 'id');
    }

    public function inner_roles()
    {
        return $this->belongsToMany(CRole::class, 'realtor_user_role', 'user_id', 'role_id', 'id', 'id');
    }

    public function professions()
    {
        return $this->belongsToMany(CProfessionType::class, 'professional_profession', 'user_id', 'profession_id', 'id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function locationCommunities()
    {
        return $this->belongsToMany(CLocationCommunity::class, 'professional_location_community', 'user_id', 'location_community_id', 'id');
    }

    public function estateTypes()
    {
        return $this->belongsToMany(CEstateType::class, 'professional_menu_estate_type', 'user_id', 'estate_type_id', 'id');
    }

    public function broker_estates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Estate::class, 'agent_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function reviews()
    {
        return $this->hasMany(Message::class, 'recipient_id')->where('message_type_id', 4);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }


    public function getAverageRatingAttribute()
    {
        return ceil($this->messages->avg('overall_rating'));
    }

    public function getContactFullNameAttribute()
    {

        if ($this->contact) {

            return $this->contact->full_name;
        }

        return null;
    }

    public function getStoragePathAttribute(): string
    {
        return $this->profile_picture_path;
    }
}
